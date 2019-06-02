<?php

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Models\Base\BaseContentModel;

class LocaleModel extends BaseContentModel
{
    protected $table = 'core_locales';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public static function initialize(
        $identifier,
        $friendly,
        $native_name,
        $display_name,
        $english_name,
        $two_letter_iso_language_name,
        $three_letter_iso_language_name,
        $is_visible = true,
        $is_enabled = true,
        $is_deleted = false,
        $flags = 0
    ) {
        $instance = new self();
        $instance->identifier = $identifier;
        $instance->friendly = $friendly;
        $instance->native_name = $native_name;
        $instance->display_name = $display_name;
        $instance->english_name = $english_name;
        $instance->two_letter_iso_language_name = $two_letter_iso_language_name;
        $instance->three_letter_iso_language_name = $three_letter_iso_language_name;
        $instance->is_visible = $is_visible;
        $instance->is_enabled = $is_enabled;
        $instance->is_deleted = $is_deleted;
        $instance->flags = $flags;
        return $instance;
    }
}
