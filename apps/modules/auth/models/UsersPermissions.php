<?php
namespace Eagle\Auth\Models;

use Phalcon\Mvc\Model;

class UsersPermissions extends Model {


    public function initialize()
    {

        $this->setConnectionService('db_default');
        $this->setSource("users_permissions");

        $this->belongsTo("user_id", 'Eagle\Auth\Models\Users', "user_id", array('alias' => 'users'));
        $this->belongsTo("permission_id", 'Eagle\Auth\Models\Permissions', "permission_id", array('alias' => 'permissions'));

    }

    public function getSource(){
        return 'users_permissions';
    }


}