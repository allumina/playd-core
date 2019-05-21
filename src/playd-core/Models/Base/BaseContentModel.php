<?php

namespace Allumina\Playd\Cms\Models\Base;

use Allumina\Playd\Core\Models\Base\BaseModel;

abstract class BaseContentModel extends BaseModel
{
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public static function boot()
    {
        parent::boot();
    }
}