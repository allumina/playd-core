<?php
/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 27/02/19
 * Time: 12:13
 */

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Models\Base\BaseContentModel;

class AttachmentModel extends BaseContentModel
{
    protected $table = 'cms_attachments';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public static function boot()
    {
        parent::boot();
    }
}
