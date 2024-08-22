<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\Base;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseRepository implements BaseRepositoryInterface
{
  protected $model;
  public function __construct(Model $model){
    $this->model = $model;
  }

  public function all(){
    return $this->model->all();
  }
  public function create(array $payload = []){
    $model = $this->model->create($payload);
    return $model->fresh();
  }
  public function update(int $id = 0, array $payload = []){
    $model = $this->findById($id);
    return $model->update($payload);
  }
  //update publish all users
  public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = []){
    return $this->model->whereIn($whereInField, $whereIn)->update($payload);
  }
  public function delete(int $id = 0){
    return $this->findById($id)->delete();
  }
  //Xoá vĩnh viễn khỏi dữ liệu
  public function forceDelete(int $id = 0){
    return $this->findById($id)->forceDelete();
  }
  public function findById($modelId, array $column = ['*'], array $relation = []){
    return $this->model->select($column)->with($relation)->findOrFail($modelId);
  }
}
