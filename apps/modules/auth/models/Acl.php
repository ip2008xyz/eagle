<?php

namespace Eagle\Auth\Models;


//use Phalcon\Acl\Adapter\Memory as AclMemory;

use Phalcon\Acl\Resource;
use Phalcon\Acl\Role;
use Phalcon\Mvc\User\Component;


class Acl extends Component
{

    const DENY = false;

    const ALLOW = true;

    protected $_permissions = array();

    const DEFAULT_ROLE = 'guest';

    protected $_module = 'index';
    protected $_controller = 'index';
    protected $_action = 'index';

    public function __construct()
    {
        //this is the default permissions


        $this->_permissions = array(
            'index_index_*' => 'index_index_*',
            'auth_index_*' => 'auth_index_*',
        );




        if($this->auth->isAuth()) {
            $tmp_permission = $this->auth->getPermissions();

            if(!is_array($tmp_permission)) {
                $tmp_permission = array();
            }
            $this->_permissions = $this->_permissions + $tmp_permission;
        } else {
            /**
             * TODO - the permissions should be on session
             */
            $permissions = Roles::findRolesPermissions(self::DEFAULT_ROLE);
            foreach($permissions as $permission) {
                $this->_permissions[$permission['permission_mca']] = $permission['permission_name'];
            }
        }



    }


    public function isAllowedToURL($url) {
        $url = ltrim($url, '/');
        $url = explode('/', $url);
        return $this->isAllowed($url[0], $url[1], $url[2]);
    }

    public function isAllowed($module = 'index', $controller = 'index', $action = 'index')
    {

        if (isset($this->_permissions["{$module}_{$controller}_{$action}"])) {
            return self::ALLOW;
        } elseif (isset($this->_permissions["{$module}_{$controller}_*"])) {
            return self::ALLOW;
        } elseif (isset($this->_permissions["{$module}_*_{$action}"])) {
            return self::ALLOW;
        } elseif (isset($this->_permissions["{$module}_*_*"])) {
            return self::ALLOW;
        } elseif (isset($this->_permissions["*_*_*"])) {
            return self::ALLOW;
        }

        return self::DENY;

    }


    public function setController($value) {
        $this->_controller = trim($value);
    }

    public function setAction($value) {
        $this->_action = trim($value);
    }

    public function setModule($value) {
        $this->_module = trim($value);
    }


    /**
     * @return string The current module/controller/action
     */
    public function getURL() {
        return "/{$this->_module}/{$this->_controller}/{$this->_action}";
    }

}