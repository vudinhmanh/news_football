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
  public function findById($modelId, array $column = ['*'], array $relation = []){
    return $this->model->select($column)->with($relation)->findOrFail($modelId);
  }
}
