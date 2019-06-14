<?php

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Common\Constants;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Allumina\Playd\Core\Models\Base\BaseModel;

class PasswordResetModel extends BaseModel // implements MustVerifyEmail
{
    public const CONTEXT = 'password_reset';

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

    protected $table = 'core_password_resets';

    public $timestamps = true;

    protected $casts = [
        'uid' => 'string',
        'identifier' => 'string',
        'create_time' => 'timestamp',
        'update_time' => 'timestamp',
        'delete_time' => 'timestamp',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'identifier',
        'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'uid',
        'friendly',
        'type',
        'category',
        'sort_index',
        'is_visible',
        'is_enabled',
        'is_deleted',
        'flags',
        'locale',
        'local_id',
        'owner_id',
        'user_id',
        'parent_id',
        'ancestor_id',
        'group_id',
        'external_id',
        'application_id',
        'environment_id',
        'version',
        'create_time',
        'update_time',
        'update_time',
        'delete_time',
        'hash',
        'raw',
        'acl',
        'remember_token',
        'password'
    ];
}
