<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Repositories\Interfaces
 */
interface PostRepositoryInterface
{
  public function getPostById(int $id = 0, $language_id = 0);
}
