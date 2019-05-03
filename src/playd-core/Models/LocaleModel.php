<?php

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Models\Base\BaseModel;

class LocaleModel extends BaseModel
{
    protected $table = 'core_locales';

    /*
    public function setNativeName($value) { $this->attributes['native_name'] = $value; }
    public function getNativeName() { return $this->attributes['native_name']; }

    public function setDislayName($value) { $this->attributes['display_name'] = $value; }
    public function getDisplayName() { return $this->attributes['display_name']; }

    public function setEnglishName($value) { $this->attributes['english_name'] = $value; }
    public function getEnglishName() { return $this->attributes['english_name']; }

    public function setNumberFormat($value) { $this->attributes['number_format'] = $value; }
    public function getNumberFormat() { return $this->attributes['number_format']; }

    public function setTwoLetterISOLanguageName($value) { $this->attributes['two_letter_iso_language_name'] = $value; }
    public function getTwoLetterISOLanguageName() { return $this->attributes['two_letter_iso_language_name']; }

    public function setThreeLetterISOLanguageName($value) { $this->attributes['three_letter_iso_language_name'] = $value; }
    public function getThreeLetterISOLanguageName() { return $this->attributes['three_letter_iso_language_name']; }
    */

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
    )
    {
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

    public static function boot()
    {
        parent::boot();
    }
}