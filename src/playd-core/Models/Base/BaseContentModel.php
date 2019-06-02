<?php

namespace Allumina\Playd\Core\Models\Base;

use Allumina\Playd\Core\Models\Base\BaseModel;
use Allumina\Playd\Core\Traits\SluggableModel;

abstract class BaseContentModel extends BaseModel
{
    use SluggableModel;

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public function parse(array $attributes = array())
    {
        parent::parse($attributes);
    }
}
