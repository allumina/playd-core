<?php

namespace Allumina\Playd\Core\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Allumina\Playd\Core\Common\Constants;

abstract class BaseModel extends Model
{
    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'create_time';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'update_time';

    /**
     * The name of the "deleted at" column.
     *
     * @var string
     */
    const DELETED_AT = 'delete_time';

    protected $primaryKey = 'identifier';

    public $timestamps = true;

    protected $casts = [
        'uid' => 'string',
        'identifier' => 'string',
        'create_time' => 'timestamp',
        'update_time' => 'timestamp',
        'delete_time' => 'timestamp',
        'latitude' => 'float',
        'longitude' => 'float'
    ];

    protected $fillable = [
        'uid',
        'identifier',
        'friendly',
        'category',
        'type',
        'is_visible',
        'is_Enabled',
        'is_deleted',
        'sort_index',
        'flags',
        'locale',
        'owner_id',
        'user_id',
        'parent_id',
        'ancestor_id',
        'group_id',
        'external_id',
        'raw',
        'acl'
    ];

    protected $guarded = [
        'version'
    ];

    protected $hidden = [
        'hash',
        'raw',
        'acl',
        'owner_id',
        'user_id',
        'parent_id',
        'ancestor_id',
        'group_id',
        'external_id',
        'application_id',
        'environment_id',
    ];

    /*
    public function setSortIndexAttribute($value) { $this->attributes['sort_index'] = $value; }
    public function getSortIndexAttribute() { return $this->attributes['sort_index']; }

    public function setIsVisibleAttribute($value) { $this->attributes['is_visible'] = $value; }
    public function getIsVisibleAttribute() { return $this->attributes['is_visible']; }

    public function setIsEnabledAttribute($value) { $this->attributes['is_enabled'] = $value; }
    public function getIsEnabledAttribute() { return $this->attributes['is_enabled']; }

    public function setIsDeletedAttribute($value) { $this->attributes['is_deleted'] = $value; }
    public function getIsDeletedAttribute() { return $this->attributes['is_deleted']; }

    public function setLocalIdAttribute($value) { $this->attributes['local_id'] = $value; }
    public function getLocalIdAttribute() { return $this->attributes['local_id']; }

    public function setOwnerIdAttribute($value) { $this->attributes['owner_id'] = $value; }
    public function getOwnerIdAttribute() { return $this->attributes['owner_id']; }

    public function setUserIdAttribute($value) { $this->attributes['user_id'] = $value; }
    public function getUserIdAttribute() { return $this->attributes['user_id']; }

    public function setParentIdAttribute($value) { $this->attributes['parent_id'] = $value; }
    public function getParentIdAttribute() { return $this->attributes['parent_id']; }

    public function setAncestorIdAttribute($value) { $this->attributes['ancestor_id'] = $value; }
    public function getAncestorIdAttribute() { return $this->attributes['ancestor_id']; }

    public function setGroupIdAttribute($value) { $this->attributes['group_id'] = $value; }
    public function getGroupIdAttribute() { return $this->attributes['group_id']; }

    public function setExternalIdAttribute($value) { $this->attributes['external_id'] = $value; }
    public function getExternalIdAttribute() { return $this->attributes['external_id']; }

    public function setApplicationIdAttribute($value) { $this->attributes['application_id'] = $value; }
    public function getApplicationIdAttribute() { return $this->attributes['application_id']; }

    public function setEnvironmentIdAttribute($value) { $this->attributes['environment_id'] = $value; }
    public function getEnvironmentIdAttribute() { return $this->attributes['environment_id']; }
    */
    // public function setCreateTimeAttribute($value) { $this->attributes['create_time'] = $value; }
    public function getCreateTimeAttribute() { return ($this->attributes['create_time'] != null) ? strtotime($this->attributes['create_time']) : null; }

    // public function setUpdateTimeAttribute($value) { $this->attributes['update_time'] = $value; }
    public function getUpdateTimeAttribute() { return ($this->attributes['update_time'] != null) ? strtotime($this->attributes['update_time']) : null; }

    // public function setDeleteTimeAttribute($value) { $this->attributes['delete_time'] = $value; }
    public function getDeleteTimeAttribute() { return ($this->attributes['delete_time'] != null) ? strtotime($this->attributes['delete_time']) : null; }

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->uid = Uuid::uuid4()->toString();
        $this->locale = '';
    }

    public function assignId()
    {
        $this->uid = Uuid::uuid4()->toString();
        return $this->uid;
    }

    public function assignIdentifier()
    {
        $this->identifier = Uuid::uuid4()->toString();
        return $this->identifier;
    }

    public function coupled($class, string $relatedTable, string $couplingTable)
    {
        return $class::join($couplingTable, $relatedTable . '.identifier', '=', $couplingTable . '.target_identifier')
            ->select($relatedTable . '.*')
            ->where($couplingTable . '.source_identifier', '=', $this->identifier)
            ->where(function($query) use($relatedTable) {
                $query->where($relatedTable . '.locale', '=', $this->locale);
                $query->orWhere($relatedTable . '.locale', '=', '');
            })
            ->orderBy($couplingTable . '.sort_index', 'ASC')
            ->get();
    }

    protected function coupledIdentifiers(string $table) {
        return DB::select('SELECT DISTINCT(target_identifier) AS identifier FROM ' . $table . ' WHERE source_identifier = :source_identifier', array(
            'source_identifier' => $this->identifier
        ));
    }

    protected function addCoupled(string $table, string $target_identifier, int $sort_index = 0)
    {
        return DB::insert('INSERT INTO ' . $table . '(source_identifier, target_identifier, sort_index) VALUES(:source_identifier, :target_identifier, :sort_index)', array(
            'source_identifier' => $this->identifier,
            'target_identifier' => $target_identifier,
            'sort_index' => $sort_index
        ));
    }

    protected function removeCoupled(string $table, string $target_identifier)
    {
        return DB::delete('DELETE FROM ' . $table . ' WHERE source_identifier = :source_identifier AND target_identifier = :targetIdentifier', array(
            'source_identifier' => $this->identifier,
            'target_identifier' => $target_identifier
        ));
    }

    protected function clearCoupled(string $table)
    {
        return DB::delete('DELETE FROM ' . $table . ' WHERE  source_identifier = :source_identifier', array(
            'source_identifier' => $this->identifier
        ));
    }

    public function attached(\stdClass $class)
    {
        return $class::where('external_id', '=', $this->identifier)
            ->where(function($query) {
               $query->where('locale', '=', $this->locale);
               $query->orWhere('locale', '=', '');
            })
            ->get();
    }

    protected function attachedIdentifiers(\stdClass $class) {
        return $class::select('identifier')->where('external_id', '=', $this->identifier)->distinct()->get();
    }

    protected function addAttached(object $obj)
    {
        $obj->external_id = $this->identifier;
        $obj->save();
    }

    protected function removeAttached(\stdClass $class, string $table, string $target_identifier)
    {
        return $class::where('external_id', '=', $this->identifier)
            ->where('identifier', '=', $target_identifier)
            ->delete();
    }

    protected function clearAttached(\stdClass $class)
    {
        return $class::where('external_id', '=', $this->identifier)
            ->delete();
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

    protected function setFillableAttribute($value)
    {
        if (count(class_parents($this)) > 1) # Check if there is more than one parent, they all need the Eloquent model.
        {
            # Yes, there are parents. We need to combine the parent $fillable with the extra ones in the child.
            $this->fillable = array_unique(array_merge($this->fillable, $value));
        } else {
            # No parents except Eloquent model.
            $this->fillable = $value;
        }
    }

    protected function setHiddenAttribute($value)
    {
        if (count(class_parents($this)) > 1) # Check if there is more than one parent, they all need the Eloquent model.
        {
            # Yes, there are parents. We need to combine the parent $hidden with the extra ones in the child.
            $this->hidden = array_unique(array_merge($this->hidden, $value));
        } else {
            # No parents except Eloquent model.
            $this->hidden = $value;
        }
    }

    protected function setGuardedAttribute($value)
    {
        if (count(class_parents($this)) > 1) # Check if there is more than one parent, they all need the Eloquent model.
        {
            # Yes, there are parents. We need to combine the parent $guarded with the extra ones in the child.
            $this->guarded = array_unique(array_merge($this->guarded, $value));
        } else {
            # No parents except Eloquent model.
            $this->guarded = $value;
        }
    }
}
