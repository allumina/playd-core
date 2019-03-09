<?php
/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 09/03/19
 * Time: 12:11
 */

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Models\Base\BaseModel;

class CountryModel extends BaseModel
{
    protected $table = 'core_countries';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->code = null;
        $this->name = null;
        $this->latitude = null;
        $this->longitude = null;
    }

    public static function initialize(
        $code,
        $name,
        $latitude,
        $longitude,
        $isVisible = true,
        $isEnabled = true,
        $isDeleted = false,
        $flags = 0
    )
    {
        $instance = new self();

        $instance->code = $code;
        $instance->name = $name;
        $instance->latitude = $latitude;
        $instance->longitude = $longitude;

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