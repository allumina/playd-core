<?php
/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 09/03/19
 * Time: 12:08
 */

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Models\Base\BaseContentModel;

class AssetModel extends BaseContentModel
{
    public const CONTEXT = 'asset';

    public const IMAGE = 'image';
    public const VIDEO = 'video';
    public const DOCUMENT = 'document';

    public const IMAGES_PATH = 'images';
    public const VIDEOS_PATH = 'videos';
    public const DOCUMENTS_PATH = 'documents';

    protected $table = 'core_assets';

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
        $filename,
        $original_filename,
        $filesize,
        $url,
        $mime,
        $is_visible = true,
        $is_enabled = true,
        $is_deleted = false,
        $flags = 0
    ) {
        $instance = new self();

        $instance->filename = $filename;
        $instance->original_filename = $original_filename;
        $instance->filesize = $filesize;
        $instance->url = $url;
        $instance->mime = $mime;

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
}
