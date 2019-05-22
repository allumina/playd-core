<?php

namespace Allumina\Playd\Core\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Laravel\Passport\HasApiTokens;

class UserModel extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;
    use EntrustUserTrait;

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

    protected $table = 'core_users';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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

    public function getRoles()
    {
        return $this->coupled(RoleModel::class, 'core_roles', 'coupled_roles');
    }

    public function addRole(RoleModel $item, int $sortIndex = 0) {
        return $this->addCoupled('coupled_roles', $item->identifier, $sortIndex);
    }

    public function removeGroup(RoleModel $item) {
        return $this->removeCoupled('coupled_roles', $item->identifier);
    }

    public function clearGroups() {
        return $this->clearCoupled('coupled_roles');
    }

    private function rolesIdentifiers() {
        return $this->coupledIdentifiers('coupled_roles');
    }
}
