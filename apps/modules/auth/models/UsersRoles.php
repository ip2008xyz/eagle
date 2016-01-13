<?php
namespace Eagle\Auth\Models;

use Eagle\Core\Models\MvcModel;

class UsersRoles extends MvcModel {


    public function initialize()
    {

        $this->setConnectionService('db_default');
        $this->setSource("users_roles");

        $this->belongsTo("user_id", 'Eagle\Auth\Models\Users', "user_id", array('alias' => 'users'));
        $this->belongsTo("role_id", 'Eagle\Auth\Models\Roles', "role_id", array('alias' => 'roles'));

    }

    public function getSource(){
        return 'users_roles';
    }


}