<?php
/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 20/02/19
 * Time: 15:55
 */

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Models\Base\BaseContentModel;

abstract class UserInfoCategories
{
    const PROFILE = 'profile';
    const ACTION = 'action';
}

abstract class UserInfoTypes
{
    const GENERIC = 'generic';
    const CHECKIN = 'checkin';
    const CHECKOUT = 'checkout';
}

class UserInfoModel extends BaseContentModel
{
    public const CONTEXT = 'userinfo';

    protected $table = 'core_user_infos';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public static function initialize(
        $identifier,
        $friendly,
        $first_name,
        $last_name,
        $locale = '',
        $is_visible = true,
        $is_enabled = true,
        $is_deleted = false,
        $flags = 0
    ) {
        $instance = new self();
        $instance->first_name = $first_name;
        $instance->last_name = $last_name;
        $instance->identifier = $identifier;
        $instance->friendly = $friendly;
        $instance->locale = $locale;
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

class UserInfoModelRevision extends UserInfoModel
{
    protected $table = 'core_user_infos_revisions';
}
