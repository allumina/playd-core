<?php
/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 20/02/19
 * Time: 15:55
 */

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Models\Base\BaseContentModel;
use Allumina\Playd\Core\Models\Base\BaseModel;
use Illuminate\Support\Facades\DB;

abstract class ContentCategories
{
    const CONTENT = 'content';
}

abstract class ContentTypes
{
    const GENERIC = 'generic';
    const INFO = 'info';
}

class ContentModel extends BaseContentModel
{
    public const CONTEXT = 'content';

    protected $table = 'core_contents';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public function parse(string $class,  array $attributes = array(), $owner = null)
    {
        parent::parse($class, $attributes, $owner);
    }

    public static function initialize(
        $identifier,
        $friendly,
        $title,
        $launch,
        $abstract,
        $body,
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
        $instance->identifier = $identifier;
        $instance->friendly = $friendly;
        $instance->locale = $locale;
        $instance->is_visible = $is_visible;
        $instance->is_enabled = $is_enabled;
        $instance->is_deleted = $is_deleted;
        $instance->flags = $flags;

        return $instance;
    }

    public static function keysSeed()
    {
        // TO DO - Add cache
        return DB::connection('data')->table('core_contents')
            ->select('category', 'type')
            ->distinct()
            ->get();
    }
}

class ContentModelRevision extends ContentModel
{
    protected $table = 'core_contents_revisions';
}
