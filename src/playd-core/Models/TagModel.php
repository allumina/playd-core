<?php
/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 20/02/19
 * Time: 15:55
 */

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Models\Base\BaseContentModel;

class TagModel extends BaseContentModel
{
    protected $table = 'cms_tags';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public static function initialize(
        $identifier,
        $friendly,
        $text,
        $notes,
        $is_visible = true,
        $is_enabled = true,
        $is_deleted = false,
        $flags = 0
    ) {
        $instance = new self();

        $instance->text = $text;
        $instance->notes = $notes;

        $instance->identifier = $identifier;
        $instance->friendly = $friendly;
        $instance->is_visible = $is_visible;
        $instance->is_enabled = $is_enabled;
        $instance->is_deleted = $is_deleted;
        $instance->flags = $flags;

        return $instance;
    }

    public static function boot()
    {
        parent::boot();
    }
}
