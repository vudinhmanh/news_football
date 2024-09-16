<?php

namespace App\Services;

use App\Services\Interfaces\PostServiceInterface;
use App\Services\BaseService;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Classes\Nestedsetbie;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
/**
 * Class PostService
 * @package App\Services
 */
class PostService extends BaseService implements PostServiceInterface
{
  protected $postRepository;
  protected $language;

  public function __construct(PostRepository $postRepository, Nestedsetbie $nestedset){
    $this->language = $this->currentLanguage();
    $this->postRepository = $postRepository;
  }
  public function paginate($request){

    $condition['keyword'] = addslashes($request->input('keyword'));
    $condition['publish'] = $request->integer('publish');
    $condition['where'] = [
      ['tb2.language_id', '=', $this->language]
    ];
    $perpage = $request->input('perpage', 10);
    $post = $this->postRepository->pagination(
      $this->paginateSelect(), 
        $condition, [
          [
            'post_language as tb2','tb2.post_id', '=', 'posts.id'
          ]
        ], 
        ['path' => 'post/index'], 
        $perpage, 
        ['post_catalogues'],
        [
          'posts.id', 'DESC',
        ]
    );  
    return $post;
  }
  //Thêm dữ liệu vào bảng post_catalogue_language
  public function create($request){
    DB::beginTransaction();
    try{
      $payload = $request->only($this->payload());
      $payload['user_id'] = Auth::id();
      $post = $this->postRepository->create($payload);

      // dd($post);
      if($post->id > 0){
        $payloadLanguage = $request->only($this->payloadLanguage());
        $payloadLanguage['canonical'] = Str::slug($payloadLanguage['canonical']);
        //Lấy 2 khoá ngoại
        $payloadLanguage['language_id'] = $this->currentLanguage();
        $payloadLanguage['post_id'] = $post->id;  
        $language = $this->postRepository->createPivot($post, $payloadLanguage, 'languages');
        // dd($language);
        $catalogue = $this->catalogue($request);
        // dd($catalogue);
        $post->post_catalogues()->sync($catalogue);
      }
      DB::commit();
      return true;
    }catch(Exception $e){ 
      DB::rollBack();
      echo $e->getMessage();
      die();
      return false;
    }
  }

  public function update($id, $request){
    DB::beginTransaction();
    try{
      $post = $this->postRepository->findById($id);
      $payload = $request->only($this->payload());
      $flag = $this->postRepository->update($id, $payload);
      if($flag == true){
        $payloadLanguage = $request->only($this->payloadLanguage());
        $payloadLanguage['canonical'] = Str::slug($payloadLanguage['canonical']);
        //Lấy 2 khoá ngoại
        $payloadLanguage['language_id'] = $this->currentLanguage();
        $payloadLanguage['post_id'] = $id;
        $post->languages()->detach($payloadLanguage['language_id'], $id);
        $response = $this->postRepository->createPivot($post, $payloadLanguage, 'languages');
        $catalogue = $this->catalogue($request);
        $post->post_catalogues()->sync($catalogue);
      }
      DB::commit();
      return true;
    }catch(Exception $e){
      DB::rollBack();
      echo $e->getMessage();
      die();
      return false;
    }
  }
  public function destroy($id){
    DB::beginTransaction();
    try{
      $this->postRepository->forceDelete($id);//hard delete
      // $user = $this->postRepository->delete($id);//soft delete
      DB::commit();
      return true;
    }catch(Exception $e){
      DB::rollBack();
      echo $e->getMessage();
      die();
      return false;
    }
  }
  public function updateStatus($post = []){
    DB::beginTransaction();
    try{
      $payload[$post['field']] = (($post['value'] == 1) ? 2 : 1);
        $user = $this->postRepository->update($post['modelId'], $payload);
        // $this->changeUserStatus($post, $payload[$post['field']]);
        DB::commit();
        return true;
    }catch(\Exception $e ){
        DB::rollBack();
        // Log::error($e->getMessage());
        echo $e->getMessage();die();
        return false;
    }
}

public function updateStatusAll($post){
  DB::beginTransaction();
  try{
      $payload[$post['field']] = $post['value'];
      $flag = $this->postRepository->updateByWhereIn('id', $post['id'], $payload);
      // $this->changeUserStatus($post, $post['value']);

      DB::commit();
      return true;
  }catch(\Exception $e ){
      DB::rollBack();
      // Log::error($e->getMessage());
      echo $e->getMessage();die();
      return false;
  }
}
// private function changeUserStatus($post, $value){
//   DB::beginTransaction();
//   try{
//       $array = [];
//       if(isset($post['modelId'])){
//           $array[] = $post['modelId'];
//       }else{
//           $array = $post['id'];
//       }
//       $payload[$post['field']] = $value;
//       $this->userRepository->updateByWhereIn('user_catalogue_id', $array, $payload);
//       DB::commit();
//       return true;
//   }catch(\Exception $e ){
//       DB::rollBack();
//       // Log::error($e->getMessage());
//       echo $e->getMessage();die();
//       return false;
//   }
// }  
private function catalogue($request)
{
    $catalogue = $request->input('catalogue') ?? [];
    return array_unique(array_merge($catalogue, [$request->post_catalogue_id]));
}

  private function paginateSelect(){
    return [
      'posts.id', 
      'posts.publish',
      'posts.image',
      'posts.order',
      'tb2.name',
      'tb2.canonical' 
    ];
  }
  private function payload(){
    return [
      'follow',
      'publish',
      'image',
      'post_catalogue_id'
    ];
  }
  private function payloadLanguage(){
     return [
      'name',
      'description',
      'content',
      'meta_title',
      'meta_keyword',
      'meta_description', 
      'canonical'
    ];
  }
}
