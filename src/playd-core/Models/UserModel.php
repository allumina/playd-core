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

    protected $table = 'core_users';

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
