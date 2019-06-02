<?php

namespace Allumina\Playd\Core\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Allumina\Playd\Core\Common\Constants;
use Allumina\Playd\Core\Traits\CoreModel;

abstract class BaseModel extends Model
{
    use CoreModel;

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
    public function getCreateTimeAttribute()
    {
        return ($this->attributes['create_time'] != null) ? strtotime($this->attributes['create_time']) : null;
    }

    // public function setUpdateTimeAttribute($value) { $this->attributes['update_time'] = $value; }
    public function getUpdateTimeAttribute()
    {
        return ($this->attributes['update_time'] != null) ? strtotime($this->attributes['update_time']) : null;
    }

    // public function setDeleteTimeAttribute($value) { $this->attributes['delete_time'] = $value; }
    public function getDeleteTimeAttribute()
    {
        return ($this->attributes['delete_time'] != null) ? strtotime($this->attributes['delete_time']) : null;
    }

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->uid = Uuid::uuid4()->toString();
        $this->locale = '';

        /*
        if (isset($attributes['uid']))1\
            $this->uid = $attributes['uid'];
        else
            $this->uid = Uuid::uuid4()->toString();

        if (isset($attributes['friendly'])) $this->friendly = $attributes['friendly'];
        if (isset($attributes['type'])) $this->type = $attributes['type'];
        if (isset($attributes['category'])) $this->category = $attributes['category'];
        if (isset($attributes['sort_index'])) $this->sort_index = $attributes['sort_index'];
        if (isset($attributes['is_visible'])) $this->is_visible = $attributes['is_visible'];
        if (isset($attributes['is_enabled'])) $this->is_enabled = $attributes['is_enabled'];
        if (isset($attributes['is_deleted'])) $this->is_deleted = $attributes['is_deleted'];
        if (isset($attributes['flags'])) $this->flags = $attributes['flags'];

        if (isset($attributes['locale']))
            $this->locale = $attributes['locale'];
        else
            $this->locale = '';

        if (isset($attributes['local_id'])) $this->local_id = $attributes['local_id'];
        if (isset($attributes['owner_id'])) $this->owner_id = $attributes['owner_id'];
        if (isset($attributes['user_id'])) $this->user_id = $attributes['user_id'];
        if (isset($attributes['parent_id'])) $this->parent_id = $attributes['parent_id'];
        if (isset($attributes['ancestor_id'])) $this->ancestor_id = $attributes['ancestor_id'];
        if (isset($attributes['group_id'])) $this->group_id = $attributes['group_id'];
        if (isset($attributes['external_id'])) $this->external_id = $attributes['external_id'];
        if (isset($attributes['application_id'])) $this->application_id = $attributes['application_id'];
        if (isset($attributes['environment_id'])) $this->environment_id = $attributes['environment_id'];
        if (isset($attributes['version'])) $this->version = $attributes['version'];
        if (isset($attributes['create_time'])) $this->create_time = $attributes['create_time'];
        if (isset($attributes['update_time'])) $this->update_time = $attributes['update_time'];
        if (isset($attributes['delete_time'])) $this->delete_time = $attributes['delete_time'];
        if (isset($attributes['hash'])) $this->hash = $attributes['hash'];
        if (isset($attributes['raw'])) $this->raw = $attributes['raw'];
        if (isset($attributes['acl'])) $this->acl = $attributes['acl'];
        */
    }

    public function parse(array $attributes = array())
    {
        if (isset($attributes['uid']))
            $this->uid = $attributes['uid'];
        else
            $this->uid = Uuid::uuid4()->toString();

        if (isset($attributes['friendly'])) $this->friendly = $attributes['friendly'];
        if (isset($attributes['type'])) $this->type = $attributes['type'];
        if (isset($attributes['category'])) $this->category = $attributes['category'];
        if (isset($attributes['sort_index'])) $this->sort_index = $attributes['sort_index'];
        if (isset($attributes['is_visible'])) $this->is_visible = $attributes['is_visible'];
        if (isset($attributes['is_enabled'])) $this->is_enabled = $attributes['is_enabled'];
        if (isset($attributes['is_deleted'])) $this->is_deleted = $attributes['is_deleted'];
        if (isset($attributes['flags'])) $this->flags = $attributes['flags'];

        if (isset($attributes['locale']))
            $this->locale = $attributes['locale'];
        else
            $this->locale = '';

        if (isset($attributes['local_id'])) $this->local_id = $attributes['local_id'];
        if (isset($attributes['owner_id'])) $this->owner_id = $attributes['owner_id'];
        if (isset($attributes['user_id'])) $this->user_id = $attributes['user_id'];
        if (isset($attributes['parent_id'])) $this->parent_id = $attributes['parent_id'];
        if (isset($attributes['ancestor_id'])) $this->ancestor_id = $attributes['ancestor_id'];
        if (isset($attributes['group_id'])) $this->group_id = $attributes['group_id'];
        if (isset($attributes['external_id'])) $this->external_id = $attributes['external_id'];
        if (isset($attributes['application_id'])) $this->application_id = $attributes['application_id'];
        if (isset($attributes['environment_id'])) $this->environment_id = $attributes['environment_id'];
        // if (isset($attributes['version'])) $this->version = $attributes['version'];
        // if (isset($attributes['create_time'])) $this->create_time = $attributes['create_time'];
        // if (isset($attributes['update_time'])) $this->update_time = $attributes['update_time'];
        // if (isset($attributes['delete_time'])) $this->delete_time = $attributes['delete_time'];
        // if (isset($attributes['hash'])) $this->hash = $attributes['hash'];
        if (isset($attributes['raw'])) $this->raw = $attributes['raw'];
        // if (isset($attributes['acl'])) $this->acl = $attributes['acl'];
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
            ->where(function ($query) use ($relatedTable) {
                $query->where($relatedTable . '.locale', '=', $this->locale);
                $query->orWhere($relatedTable . '.locale', '=', '');
            })
            ->orderBy($couplingTable . '.sort_index', 'ASC')
            ->get();
    }

    protected function coupledIdentifiers(string $table)
    {
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
            ->where(function ($query) {
                $query->where('locale', '=', $this->locale);
                $query->orWhere('locale', '=', '');
            })
            ->get();
    }

    protected function attachedIdentifiers(\stdClass $class)
    {
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

    public static function sanitize(string $text)
    {
        $text = strtolower($text);
        $text = preg_replace('~([^a-z0-9\-])~i', '', $text);
        $text = preg_replace('~\-\-+~', '-', $text);
        echo $text . "\n";
        return $text;
    }
}
