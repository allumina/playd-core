<?php

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Models\Base\BaseContentModel;

class RevisionModel extends BaseContentModel
{
    public const CONTEXT = 'revision';

    protected $table = 'core_revisions';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }
}
