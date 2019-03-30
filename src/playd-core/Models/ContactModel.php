<?php
/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 09/03/19
 * Time: 12:08
 */

namespace Allumina\Playd\Core\Models;


class ContactModel
{
    protected $table = 'core_contacts';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->type = null;
        $this->value = null;
    }

    public static function initialize(
        $type,
        $value,
        $isVisible = true,
        $isEnabled = true,
        $isDeleted = false,
        $flags = 0
    ) {
        $instance = new self();

        $instance->type = $type;
        $instance->value = $value;

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