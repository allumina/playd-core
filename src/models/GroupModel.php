<?php

namespace Allumina\Playd\Models;

use Allumina\Playd\Models\Base\BaseModel;

class GroupModel extends BaseModel
{
    protected $table = 'groups';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public static function boot()
    {
        parent::boot();
    }
}