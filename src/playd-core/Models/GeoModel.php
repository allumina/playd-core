<?php

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Models\Base\BaseModel;

class GeoModel extends BaseModel
{
    protected $table = 'core_geo';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->address = null;
        $this->city = null;
        $this->district = null;
        $this->postalCode = null;
        $this->country = null;
        $this->latitude = null;
        $this->longitude = null;
    }

    public static function initialize(
        $address,
        $city,
        $district,
        $postalCode,
        $country,
        $latitude,
        $longitude,
        $isVisible = true,
        $isEnabled = true,
        $isDeleted = false,
        $flags = 0
    )
    {
        $instance = new self();

        $instance->address = $address;
        $instance->city = $city;
        $instance->district = $district;
        $instance->postalCode = $postalCode;
        $instance->country = $country;
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

    /**
     * Get the phone record associated with the user.
     */
    public function country()
    {
        return $this->hasOne('Allumina\Playd\Core\Models\CountryModel');
    }
}