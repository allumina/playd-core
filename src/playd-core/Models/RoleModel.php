<?php

/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 09/03/19
 * Time: 12:08
 */

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Models\Base\BaseModel;

class RoleModel extends BaseModel
{
    protected $connection = 'auth';
    protected $table = 'core_roles';

    public const CONTEXT = 'role';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public static function initialize(
        $identifier,
        $friendly,
        $locale,
        $category,
        $type,
        $name,
        $description,
        $is_visible = true,
        $is_enabled = true,
        $is_deleted = false,
        $flags = 0
    ) {
        $instance = new self();

        $instance->name = $name;
        $instance->description = $description;

        $instance->identifier = $identifier;
        $instance->friendly = $friendly;
        $instance->category = $category;
        $instance->type = $type;
        $instance->locale = $locale;
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
