<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Repositories\Interfaces
 */
interface UserRepositoryInterface
{
  public function pagination(array $column = ['*'], array $condition = [], array $join = [], array $extend = [],int $perpage = 10, array $relation = []);
}
