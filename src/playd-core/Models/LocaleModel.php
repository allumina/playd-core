<?php

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Models\Base\BaseModel;

class LocaleModel extends BaseModel
{
    protected $table = 'core_locales';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->code = null;
        $this->nativeName = null;
        $this->displayName = null;
        $this->englishName = null;
        $this->twoLetterISOLanguageName = null;
        $this->threeLetterISOLanguageName = null;
    }

    public static function initialize(
    $code,
    $nativeName,
    $displayName,
    $englishName,
    $twoLetterISOLanguageName,
    $threeLetterISOLanguageName,
    $isVisible = true,
    $isEnabled = true,
    $isDeleted = false,
    $flags = 0
) {
    $instance = new self();

    $instance->code = $code;
    $instance->nativeName = $nativeName;
    $instance->displayName = $displayName;
    $instance->englishName = $englishName;
    $instance->twoLetterISOLanguageName = $twoLetterISOLanguageName;
    $instance->threeLetterISOLanguageName = $threeLetterISOLanguageName;

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