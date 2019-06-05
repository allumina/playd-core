<?php
/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 09/03/19
 * Time: 12:11
 */

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Models\Base\BaseContentModel;
use Ramsey\Uuid\Uuid;

class CountryModel extends BaseContentModel
{
    public const CONTEXT = 'country';

    protected $table = 'core_countries';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public static function initialize(
        $identifier,
        $friendly,
        $name,
        $latitude,
        $longitude,
        $is_visible = true,
        $is_enabled = true,
        $is_deleted = false,
        $flags = 0
    ) {
        $instance = new self();

        $instance->name = $name;
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
