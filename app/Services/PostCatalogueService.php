<?php

namespace App\Services;

use App\Services\Interfaces\PostCatalogueServiceInterface;
use App\Services\BaseService;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
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
 * Class UserService
 * @package App\Services
 */
class PostCatalogueService extends BaseService implements PostCatalogueServiceInterface
{
  protected $postCatalogueRepository;
  protected $nestedset;
  protected $language;

  public function __construct(PostCatalogueRepository $postCatalogueRepository, Nestedsetbie $nestedset){
    $this->language = $this->currentLanguage();
    $this->postCatalogueRepository = $postCatalogueRepository;
    $this->nestedset = new Nestedsetbie(
      [
        'table' => 'post_catalogues',
        'foreignkey' => 'post_catalogue_id',
        'language_id' => $this->language,
      ]
    );
  }
  public function paginate($request){
    $perpage = $request->input('perpage', 10);
    $condition = [
      'keyword' => addslashes($request->input('keyword')),
      'publish' => $request->integer('publish'),
      'where' => [
          ['tb2.language_id', '=', $this->language]
      ]
  ];
  $postCatalogues = $this->postCatalogueRepository->pagination(
    $this->paginateSelect(), 
    $condition, 
    $perpage,
    ['path' => 'post/catalogue/index'],  //path phan trang
    ['post_catalogues.lft', 'ASC'],
    [
        ['post_catalogue_language as tb2','tb2.post_catalogue_id', '=' , 'post_catalogues.id']
    ], 
);
    // dd($postCatalogue);
    return $postCatalogues;
  }
  //Thêm dữ liệu vào bảng post_catalogue_language
  public function create($request){
    DB::beginTransaction();
    try{
      $payload = $request->only($this->payload());
      $payload['user_id'] = Auth::id();
      $postCatalogue = $this->postCatalogueRepository->create($payload);
      if($postCatalogue->id > 0){
        $payloadLanguage = $request->only($this->payloadLanguage());
        // $payloadLanguage['canonical'] = Str::slug($payloadLanguage['canonical']);
        //Lấy 2 khoá ngoại
        $payloadLanguage['language_id'] = $this->currentLanguage();
        $payloadLanguage['post_catalogue_id'] = $postCatalogue->id;
        $language = $this->postCatalogueRepository->createPivot($postCatalogue, $payloadLanguage, 'languages');
      }
      $this->nestedset->Get('level ASC, order ASC');
      $this->nestedset->Recursive(0, $this->nestedset->Set());
      $this->nestedset->Action();
      
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
      $postCatalogue = $this->postCatalogueRepository->findById($id);
      $payload = $request->only($this->payload());
      $flag = $this->postCatalogueRepository->update($id, $payload);
      if($flag == true){
        $payloadLanguage = $request->only($this->payloadLanguage());
        // $payloadLanguage['canonical'] = Str::slug($payloadLanguage['canonical']);
        //Lấy 2 khoá ngoại
        $payloadLanguage['language_id'] = $this->currentLanguage();
        $payloadLanguage['post_catalogue_id'] = $id;
        $postCatalogue->languages()->detach($payloadLanguage['language_id'], $id);
        $response = $this->postCatalogueRepository->createPivot($postCatalogue, $payloadLanguage, 'languages');
        $this->nestedset->Get('level ASC, order ASC');
        $this->nestedset->Recursive(0, $this->nestedset->Set());
        $this->nestedset->Action();
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
      $this->postCatalogueRepository->forceDelete($id);//hard delete

      $this->nestedset->Get('level ASC, order ASC');
      $this->nestedset->Recursive(0, $this->nestedset->Set());
      $this->nestedset->Action();
      // $user = $this->postCatalogueRepository->delete($id);//soft delete
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
        $user = $this->postCatalogueRepository->update($post['modelId'], $payload);
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
      $flag = $this->postCatalogueRepository->updateByWhereIn('id', $post['id'], $payload);
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
  private function paginateSelect(){
    return [
      'post_catalogue_id', 
      'post_catalogues.publish',
      'post_catalogues.image',
      'post_catalogues.level',
      'post_catalogues.order',
      'tb2.name',
      'tb2.canonical' 
    ];
  }
  private function payload(){
    return [
      'parentid',
      'follow',
      'publish',
      'image'
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
