<?php
namespace Allumina\Playd\Core\Traits;

use Ramsey\Uuid\Uuid;
use Allumina\Playd\Core\Common\Constants;

trait CoreModel
{
  public static function bootCoreModel()
  {
    static::saving(function ($model) {
      $model->version = $model->version + 1;
      unset($model->hash);
      $model->hash = hash(Constants::HASH_ALGORITHM, json_encode($model));
    });
  }
}
