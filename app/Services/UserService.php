<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
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
class UserService implements UserServiceInterface
{
  protected $userRepository;
  public function __construct(UserRepository $userRepository){
    $this->userRepository = $userRepository;
  }
  public function paginate($request){
    $condition['keyword'] = addslashes($request->input('keyword'));
    $condition['catalogue'] = $request->integer('catalogue');
    $perpage = $request->integer('perpage');
    $user = $this->userRepository->pagination(
      $this->paginateSelect(), $condition, [], ['path' => '/user/index'], $perpage
    );
    return $user;
  }
  public function create($request){
    DB::beginTransaction();
    try{
      //except lấy tất cả ngoại trừ
      $payload = $request->except(['_token','send', 're_password']);
      $payload['birthday'] = $this->convertBirthdayDate($payload['birthday']);
      $payload['password'] = Hash::make($payload['password']);
      $user = $this->userRepository->create($payload);
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
      $payload['birthday'] = $this->convertBirthdayDate($payload['birthday']);
      // dd($payload);
      $user = $this->userRepository->update($id,$payload);
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
      $user = $this->userRepository->forceDelete($id);//hard delete
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
      $payload[$post['field']] = (($post['value'] == 1) ? 0 : 1);
      $user = $this->userRepository->update($post['modelId'], $payload);
      DB::commit();
      return true;
    }catch(Exception $e){
      DB::rollBack();
      echo $e->getMessage();
      die();
      return false;
    }
  }

  public function updateStatusAll($post){
    DB::beginTransaction();
    try{
      $payload[$post['field']] = $post['value'];
      $flag = $this->userRepository->updateByWhereIn('id', $post['id'], $payload);
      DB::commit();
      return true;
    }catch(Exception $e){
      DB::rollBack();
      echo $e->getMessage();
      die();
      return false;
    }
  }
  private function convertBirthdayDate($birthday = '') {
    $carbonDate = Carbon::createFromFormat('Y-m-d', $birthday);
    $birthday = $carbonDate->format('Y-m-d H:i:s');
    return $birthday;
  }
  private function paginateSelect(){
    return [
      'id', 
      'name',
      'email', 
      'phone', 
      'address',
      'publish' ,
      'user_catalogue_id'
    ];
  }
}
