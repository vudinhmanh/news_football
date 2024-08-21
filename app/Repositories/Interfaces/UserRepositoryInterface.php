<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Repositories\Interfaces
 */
interface UserRepositoryInterface
{
  public function getAllPaginate();
  public function create();
  public function findById(int $id);
  public function update(int $id = 0, array $payload = []);
  public function delete(int $id = 0);
  //Hard delete
  public function forceDelete(int $id = 0);
  public function pagination(array $column = ['*'], array $condition = [], array $join = [], array $extend = [],int $perpage = 10);
  public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = []);
}
