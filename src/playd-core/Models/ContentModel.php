<?php
/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 20/02/19
 * Time: 15:55
 */

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Cms\Models\Base\BaseContentModel;

class ContentModel extends BaseContentModel
{
    protected $table = 'core_contents';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public static function initialize(
        $identifier,
        $friendly,
        $title,
        $launch,
        $abstract,
        $body,
        $text,
        $locale = '',
        $is_visible = true,
        $is_enabled = true,
        $is_deleted = false,
        $flags = 0
    ) {
        $instance = new self();

        $instance->title = $title;
        $instance->launch = $launch;
        $instance->abstract = $abstract;
        $instance->body = $body;
        $instance->text = $text;

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

        static::creating(function ($model) {
            parent::creating($model);
            $model->slug = self::sanitize($model->title);
        });

        static::updating(function ($model) {
            parent::updating($model);
            $model->slug = self::sanitize($model->title);
        });
    }

    private static function sanitize(string $text) {
        $text = strtolower($text);
        $text = preg_replace( '~([^a-z0-9\-])~i', '', $text );
        $text = preg_replace( '~\-\-+~', '-', $text );
        return $text;
    }
}
