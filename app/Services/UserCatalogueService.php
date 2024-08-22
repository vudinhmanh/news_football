<?php

namespace App\Services;

use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;

use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
/**
 * Class UserService
 * @package App\Services
 */
class UserCatalogueService implements UserCatalogueServiceInterface
{
  protected $userCatalogueRepository;
  protected $userRepository;
  public function __construct(UserCatalogueRepository $userCatalogueRepository, UserRepository $userRepository){
    $this->userRepository = $userRepository;
    $this->userCatalogueRepository = $userCatalogueRepository;
  }
  public function paginate($request){

    $condition['keyword'] = addslashes($request->input('keyword'));
    $perpage = $request->integer('perpage');
    $userCatalogue = $this->userCatalogueRepository->pagination(
      $this->paginateSelect(), $condition, [], ['path' => '/user/catalogue/index'], 
              $perpage, ['users']
    );
    return $userCatalogue;
  }
  public function create($request){
    DB::beginTransaction();
    try{
      //except lấy tất cả ngoại trừ
      $payload = $request->except(['_token','send',]);
      $user = $this->userCatalogueRepository->create($payload);
      // dd($user);
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
      //except lấy tất cả ngoại trừ
      $payload = $request->except(['_token','send']);
      // dd($payload);
      $user = $this->userCatalogueRepository->update($id,$payload);
      // dd($user);
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
      $this->userCatalogueRepository->forceDelete($id);//hard delete
      // $user = $this->userRepository->delete($id);//soft delete
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
        $payload[$post['field']] = (($post['value'] == 1)?2:1);
        $user = $this->userCatalogueRepository->update($post['modelId'], $payload);
        $this->changeUserStatus($post, $payload[$post['field']]);

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
      $flag = $this->userCatalogueRepository->updateByWhereIn('id', $post['id'], $payload);
      $this->changeUserStatus($post, $post['value']);

      DB::commit();
      return true;
  }catch(\Exception $e ){
      DB::rollBack();
      // Log::error($e->getMessage());
      echo $e->getMessage();die();
      return false;
  }
}
private function changeUserStatus($post, $value){
  DB::beginTransaction();
  try{
      $array = [];
      if(isset($post['modelId'])){
          $array[] = $post['modelId'];
      }else{
          $array = $post['id'];
      }
      $payload[$post['field']] = $value;
      $this->userRepository->updateByWhereIn('user_catalogue_id', $array, $payload);
      DB::commit();
      return true;
  }catch(\Exception $e ){
      DB::rollBack();
      // Log::error($e->getMessage());
      echo $e->getMessage();die();
      return false;
  }
}
  private function paginateSelect(){
    return [
      'id', 
      'name',
      'description',
      'publish',
    ];
  }
}
