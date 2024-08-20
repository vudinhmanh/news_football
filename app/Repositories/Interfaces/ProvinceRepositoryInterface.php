<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Repositories\Interfaces
 */
interface ProvinceRepositoryInterface
{
  public function all();
  public function findById($modelId, array $column = ['*'], array $relation = []);
}
