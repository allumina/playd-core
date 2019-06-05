<?php
/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 20/02/19
 * Time: 15:55
 */

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Models\Base\BaseContentModel;

class ApplicationModel extends BaseContentModel
{
    public const CONTEXT = 'application';

    protected $table = 'core_applications';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public static function initialize(
        $identifier,
        $friendly,
        $name,
        $locale = '',
        $is_visible = true,
        $is_enabled = true,
        $is_deleted = false,
        $flags = 0
    ) {
        $instance = new self();
        $instance->name = $name;
        $instance->identifier = $identifier;
        $instance->friendly = $friendly;
        $instance->locale = $locale;
        $instance->is_visible = $is_visible;
        $instance->is_enabled = $is_enabled;
        $instance->is_deleted = $is_deleted;
        $instance->flags = $flags;

        return $instance;
    }
}
