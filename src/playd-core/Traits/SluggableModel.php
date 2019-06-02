<?php
namespace Allumina\Playd\Core\Traits;

trait SluggableModel
{
  public static function bootSluggableModel()
  {
    static::saving(function ($model) {
      $model->slug = $model->generateSlug($model->title);
    });
  }

  public function generateSlug($string)
  {
    return strtolower(preg_replace(
      ['/[^\w\s]+/', '/\s+/'],
      ['', '-'],
      $string
    ));
  }
}
