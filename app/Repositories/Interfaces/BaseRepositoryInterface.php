<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Repositories\Interfaces
 */
interface BaseRepositoryInterface
{
  public function all();
  public function create(array $payload);
  public function findById(int $id);
  public function update(int $id = 0, array $payload = []);
  public function delete(int $id = 0);
  public function pagination(
    array $column = ['*'], 
    array $condition = [], 
    array $join = [], 
    array $extend = [],
    int $perpage = 10, 
    array $relation = [],
    array $orderBy = []);
  public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = []);
  public function createLanguagePivot($model, array $payload = []);
}