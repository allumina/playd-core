<?php
/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 09/03/19
 * Time: 12:08
 */

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Models\Base\BaseModel;

class ContactModel extends BaseModel
{
    public const WEBSITE = 'website';
    public const PHONE = 'phone';
    public const INFO = 'info';
    public const BOOKING = 'booking';
    public const EMAIL = 'email';
    public const SOCIAL = 'social';
    public const FACEBOOK = 'facebook';
    public const TRIPADVISOR = 'tripadvisor';
    public const TWITTER = 'twitter';
    public const INSTAGRAM = 'instagram';
    public const PINTEREST = 'pinterest';

    protected $table = 'core_contacts';

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
        $value,
        $is_visible = true,
        $is_enabled = true,
        $is_deleted = false,
        $flags = 0
    ) {
        $instance = new self();

        $instance->value = $value;

        $instance->identifier = $identifier;
        $instance->friendly = $friendly;
        $instance->locale = $locale;
        $instance->category = $category;
        $instance->type = $type;
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