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

class UserModel extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;
    use EntrustUserTrait;

    public const CONTEXT = 'user';

    public const IMAGES_PATH = 'users';

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

    protected $connection = 'auth';
    protected $table = 'core_users';

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
        'name',
        'email',
        'password',
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

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->uid = Uuid::uuid4()->toString();
        $this->locale = '';
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uid = Uuid::uuid4()->toString();
            if (!isset($model->identifier)) $model->assignIdentifier();
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

    public function getRoles()
    {
        return $this->coupled(RoleModel::class, 'core_roles', 'coupled_roles');
    }

    public function addRole(RoleModel $item, int $sortIndex = 0)
    {
        return $this->addCoupled('coupled_roles', $item->identifier, $sortIndex);
    }

    public function removeGroup(RoleModel $item)
    {
        return $this->removeCoupled('coupled_roles', $item->identifier);
    }

    public function clearGroups()
    {
        return $this->clearCoupled('coupled_roles');
    }

    private function rolesIdentifiers()
    {
        return $this->coupledIdentifiers('coupled_roles');
    }

    public function findForPassport($username)
    {
        return $this->where('email', $username)->first();
    }

    public function getUserKey(string $context, String $category = null, String $type = null)
    {
        $category_check = ($category && strlen($category) > 0) ? $category : '';
        $type_check = ($type && strlen($type) > 0) ? $type : '';
        $encoded = $this->identifier . '@' . config('app.key') . '$' . $context . '$' . $category_check . '$' . $type_check;
        // return Hash::make($encoded);
        // return hash('sha256', $encoded);
        // return password_hash($encoded, PASSWORD_BCRYPT, ['cost' => 12, 'salt' => config('app.key')]);
        // return Crypt::encrypt($encoded);

        // $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
        return base64_encode($encoded);
        // TO DO : find a better way!
    }

    public static function getGenericImage()
    {
        return Storage::path(UserModel::IMAGES_PATH . '/' . 'generic.png');
    }
}
