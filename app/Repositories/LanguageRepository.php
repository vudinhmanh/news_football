<?php

namespace App\Repositories;

use App\Models\Languages;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\LanguageRepositoryInterface;

/**
 * Class UserService
 * @package App\Services
 */
class LanguageRepository extends BaseRepository implements LanguageRepositoryInterface
{
  public function __construct(Languages $model){
    $this->model = $model;
  }

}
