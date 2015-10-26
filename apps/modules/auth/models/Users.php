<?php
namespace Eagle\Auth\Models;

use Phalcon\Mvc\Model;

class Users extends Model {

    const ACTIVE = 1;
    const INACTIVE = 0;

    public function initialize()
    {

        $this->setConnectionService('db_default');
        $this->setSource("users");

        $this->hasManyToMany(
            "user_id",
            'Eagle\Auth\Models\UsersPermissions',
            "user_id",
            "permission_id",
            'Eagle\Auth\Models\Permissions',
            "permission_id",
            array('alias' => 'permissions')
        );

        $this->hasManyToMany(
            "user_id",
            'Eagle\Auth\Models\UsersRoles',
            "user_id",
            "role_id",
            'Eagle\Auth\Models\Roles',
            "role_id",
            array('alias' => 'roles')
        );
    }


    /**
     * Return the related "Roles"
     *
     * @return \Roles[]
     */
    public function getRoles($parameters = null)
    {
        return $this->getRelated('roles', $parameters);
    }

    public function getPermissions($parameters = null)
    {
        return $this->getRelated('permissions', $parameters);
    }


    public function getSource(){
        return 'users';
    }


    public function getAllPermissions() {

        $permissions = array();

        $roles = $this->getRoles();

        foreach($roles as $role) {
            $permissions = array_merge($permissions, $role->getPermissions()->toArray());

        }

        $permissions = array_merge($permissions, $this->getPermissions()->toArray());

        return $permissions;
    }

}