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
}
