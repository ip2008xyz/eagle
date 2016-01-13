<?php
namespace Eagle\Auth\Models;

use Eagle\Core\Models\MvcModel;

class Permissions extends MvcModel {


    public function initialize()
    {

        $this->setConnectionService('db_default');
        $this->setSource("permissions");

        $this->hasManyToMany(
            "permission_id",
            'Eagle\Auth\Models\RolesPermissions',
            "permission_id",
            "role_id",
            'Eagle\Auth\Models\Roles',
            "role_id",
            array('alias' => 'roles')
        );


        $this->hasManyToMany(
            "permission_id",
            'Eagle\Auth\Models\RolesPermissions',
            "permission_id",
            "user_id",
            'Eagle\Auth\Models\Users',
            "user_id",
            array('alias' => 'users')
        );
    }

    public function getSource(){
        return 'permissions';
    }
}