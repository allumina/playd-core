<?php
/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 27/02/19
 * Time: 12:49
 */

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Cms\Models\Base\BaseContentModel;

class AuthorModel extends BaseContentModel
{
    protected $table = 'cms_authors';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public static function boot()
    {
        parent::boot();
    }
}
