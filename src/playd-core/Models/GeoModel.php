<?php

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Models\Base\BaseModel;

class GeoModel extends BaseModel
{
    protected $table = 'core_geo';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public static function initialize(
        $identifier,
        $friendly,
        $address,
        $city,
        $district,
        $postal_code,
        $country,
        $latitude,
        $longitude,
        $is_visible = true,
        $is_enabled = true,
        $is_deleted = false,
        $flags = 0
    )
    {
        $instance = new self();

        $instance->address = $address;
        $instance->city = $city;
        $instance->district = $district;
        $instance->postal_code = $postal_code;
        $instance->country = $country;
        $instance->latitude = $latitude;
        $instance->longitude = $longitude;

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