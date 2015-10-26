<?php
namespace Eagle\Auth\Models;

use Phalcon\Mvc\Model;

class RolesPermissions extends Model {


    public function initialize()
    {

        $this->setConnectionService('db_default');
        $this->setSource("roles_permissions");
        $this->belongsTo("role_id", 'Eagle\Auth\Models\Roles', "role_id", array('alias' => 'roles'));
        $this->belongsTo("permission_id", 'Eagle\Auth\Models\Permissions', "permission_id", array('alias' => 'permissions'));

    }

    public function getSource(){
        return 'roles_permissions';
    }


}