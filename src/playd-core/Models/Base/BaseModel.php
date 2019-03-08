<?php

namespace Allumina\Playd\Core\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Allumina\Playd\Core\Common\Constants;

abstract class BaseModel extends Model
{
    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'createTime';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'updateTime';

    /**
     * The name of the "deleted at" column.
     *
     * @var string
     */
    const DELETED_AT = 'deleteTime';

    protected $primaryKey = 'uid';

    public $timestamps = true;

    protected $casts = [
        'uid' => 'string',
        'createTime' => 'timestamp',
        'updateTime' => 'timestamp',
        'deleteTime' => 'timestamp',
    ];

    protected $fillable = [
        'uid',
        'category',
        'type',
        'isVisible',
        'isEnabled',
        'isDeleted',
        'flags',
        'ownerId',
        'userId',
        'parentId',
        'ancestorId',
        'groupId',
        'raw'
    ];

    protected $guarded = [
        'version'
    ];

    protected $hidden = [
        'hash'
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->uid = Uuid::uuid4()->toString();
    }

    public function assignId()
    {
        $this->uid = Uuid::uuid4()->toString();
    }

    protected function __parse(array $attributes = array())
    {
        if (!empty($attributes['uid'])) {
            $this->uid = $attributes['uid'];
        }
        if (!empty($attributes['category'])) {
            $this->category = $attributes['category'];
        }
        if (!empty($attributes['type'])) {
            $this->type = $attributes['type'];
        }
        if (!empty($attributes['isVisible'])) {
            $this->isVisible = $attributes['isVisible'];
        }
        if (!empty($attributes['isEnabled'])) {
            $this->isEnabled = $attributes['isEnabled'];
        }
        if (!empty($attributes['isDeleted'])) {
            $this->isDeleted = $attributes['isDeleted'];
        }
        if (!empty($attributes['flags'])) {
            $this->flags = $attributes['flags'];
        }
        if (!empty($attributes['localId'])) {
            $this->localId = $attributes['localId'];
        }
        if (!empty($attributes['ownerId'])) {
            $this->ownerId = $attributes['ownerId'];
        }
        if (!empty($attributes['userId'])) {
            $this->userId = $attributes['userId'];
        }
        if (!empty($attributes['parentId'])) {
            $this->parentId = $attributes['parentId'];
        }
        if (!empty($attributes['ancestorId'])) {
            $this->ancestorId = $attributes['ancestorId'];
        }
        if (!empty($attributes['groupId'])) {
            $this->groupId = $attributes['groupId'];
        }
        if (!empty($attributes['applicationId'])) {
            $this->applicationId = $attributes['applicationId'];
        }
        if (!empty($attributes['environmentId'])) {
            $this->environmentId = $attributes['environmentId'];
        }
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uid = Uuid::uuid4()->toString();
            $model->version = 1;
            unset($model->hash);
            $model->hash = hash(Constants::HASH_ALGORITHM, json_encode($model));
        });

        static::updating(function ($model) {
            $model->version = $model->version + 1;
            unset($model->hash);
            $model->hash = hash(Constants::HASH_ALGORITHM, json_encode($model));
        });
    }

    public static function candidate(string $model, string $uid = null, int $version = -1, string $userId = null, string $ownerId = null)
    {
        if (!is_null($uid)) {

            $item = null;

            if (!is_null($ownerId)) {
                $item = $model::where('uid', '=', $uid)->where('ownerId', '=', $ownerId)->first();
            } else {
                if (!is_null($userId)) {
                    $item = $model::where('uid', '=', $uid)->where('userId', '=', $userId)->first();
                } else {
                    $item = $model::where('uid', '=', $uid)->first();
                }
            }

            if (is_null($item)) {
                $item = new $model;
                $item->version = 1;
            } else {
                if ($version >= 0 && $version < $item->version) {
                    return null;
                }
            }
            return $item;
        }
        return null;
    }

    protected function setFillableAttribute($value)
    {
        dd('setFillableAttribute');

        if (count(class_parents($this)) > 1) # Check if there is more than one parent, they all need the Eloquent model.
        {
            # Yes, there are parents. We need to combine the parent $fillable with the extra ones in the child.
            $this->fillable = array_unique(array_merge($this->fillable, $value));
        }
        else
        {
            # No parents except Eloquent model.
            $this->fillable = $value;
        }
    }

    protected function setHiddenAttribute($value)
    {
        if (count(class_parents($this)) > 1) # Check if there is more than one parent, they all need the Eloquent model.
        {
            # Yes, there are parents. We need to combine the parent $hidden with the extra ones in the child.
            $this->hidden = array_unique(array_merge($this->hidden,$value));
        }
        else
        {
            # No parents except Eloquent model.
            $this->hidden = $value;
        }
    }

    protected function setGuardedAttribute($value)
    {
        if (count(class_parents($this)) > 1) # Check if there is more than one parent, they all need the Eloquent model.
        {
            # Yes, there are parents. We need to combine the parent $guarded with the extra ones in the child.
            $this->guarded = array_unique(array_merge($this->guarded,$value));
        }
        else
        {
            # No parents except Eloquent model.
            $this->guarded = $value;
        }
    }

}
