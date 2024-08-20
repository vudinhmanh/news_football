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
  public function paginate(){
    $user = $this->userRepository->getAllPaginate();
    return $user;
  }
  public function create($request){
    DB::beginTransaction();
    try{
      //except lấy tất cả ngoại trừ
      $payload = $request->except(['_token','send', 're_password']);
      $carbonDate = Carbon::createFromFormat('Y-m-d', $payload['birthday']);
      $payload['birthday'] = $carbonDate->format('Y-m-d H:i:s');
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
}
