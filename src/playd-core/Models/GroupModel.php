<?php
/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 09/03/19
 * Time: 12:08
 */

namespace Allumina\Playd\Core\Models;


class GroupModel
{
    protected $table = 'core_groups';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->name = null;
        $this->description = null;
    }

    public static function initialize(
        $name,
        $description,
        $isVisible = true,
        $isEnabled = true,
        $isDeleted = false,
        $flags = 0
    ) {
        $instance = new self();

        $instance->name = $name;
        $instance->description = $description;

        $instance->isVisible = $isVisible;
        $instance->isEnabled = $isEnabled;
        $instance->isDeleted = $isDeleted;
        $instance->flags = $flags;

        return $instance;
    }

    public static function boot()
    {
        parent::boot();
    }
}