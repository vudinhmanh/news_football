<?php

namespace App\Services;

use App\Services\Interfaces\PermissionServiceInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
/**
 * Class UserService
 * @package App\Services
 */
class PermissionService implements PermissionServiceInterface
{
  protected $permissionRepository;

  public function __construct(PermissionRepository $permissionRepository){

    $this->permissionRepository = $permissionRepository;
  }
  public function paginate($request){

    $condition['keyword'] = addslashes($request->input('keyword'));
    $condition['publish'] = $request->integer('publish');
    $perpage = $request->integer('perpage');
    $permissions = $this->permissionRepository->pagination(
      $this->paginateSelect(), 
      $condition, 
      $perpage, 
      ['path' => 'permission/index'], 
  );
    return $permissions;
  }
  public function create($request){
    DB::beginTransaction();
    try{
      //except lấy tất cả ngoại trừ
      $payload = $request->except(['_token','send',]);
      $payload['user_id'] = Auth::id();
      $user = $this->permissionRepository->create($payload);
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
      $user = $this->permissionRepository->update($id,$payload);
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
      $this->permissionRepository->forceDelete($id);//hard delete
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
        $user = $this->permissionRepository->update($post['modelId'], $payload);
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
        $flag = $this->permissionRepository->updateByWhereIn('id', $post['id'], $payload);
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
  public function setPermission(){
    
  }
  private function paginateSelect(){
    return [
      'id', 
      'name',
      'canonical',
    ];
  }
}
