<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Repositories\Interfaces
 */
interface UserCatalogueRepositoryInterface
{
  public function pagination(array $column = ['*'], array $condition = [], array $join = [], array $extend = [], int $perpage = 10, array $relations = []);
}
