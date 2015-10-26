<?php
namespace Eagle\Auth\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\Inclusionin;
use Phalcon\Mvc\Model\Validator\Regex;

class Roles extends Model
{

    const ACTIVE = 1;
    const INACTIVE = 0;

    public function initialize()
    {

        $this->setConnectionService('db_default');
        $this->setSource("roles");

        $this->hasManyToMany(
            "role_id",
            'Eagle\Auth\Models\RolesPermissions',
            "role_id",
            "permission_id",
            'Eagle\Auth\Models\Permissions',
            "permission_id",
            array('alias' => 'permissions')
        );/**/
    }

    public function getSource()
    {
        return 'roles';
    }


    /**
     * Return the related "Roles Permissions"
     *
     * @return \RolesPermissions[]
     */
    public function getPermissions($parameters = null)
    {
        return $this->getRelated('permissions', $parameters);
    }

    /**
     * Return the related "Roles Permissions" for a array of roles names
     *
     * @param $roles mixed
     * @return array
     */
    public static function findRolesPermissions($roles)
    {

        if (!is_array($roles)) {
            $roles = array($roles);
        }

        $roles = self::findAllForRoles($roles);
        $permissions = array();
        foreach ($roles as $role) {
            $permissions = array_merge($permissions, $role->getPermissions()->toArray());
        }

        return $permissions;
    }

    public static function findAllForRoles($roles)
    {
        return self::find(array(
            "role_name IN ({roles:array}) AND role_active = {role_active}",
            'bind' => array(
                'roles' => $roles,
                'role_active' => self::ACTIVE,
            )
        ));
    }


    public static function changeActive($role_id)
    {

        $role = Roles::findFirst($role_id);
        if ($role) {
            $role->role_active = ($role->role_active == Roles::ACTIVE) ? Roles::INACTIVE : Roles::ACTIVE;
            return $role->save();
        }
        return false;
    }


    protected $role_id;
    protected $role_name;
    protected $role_active;

    public function getRoleId()
    {
        return (int)$this->role_id;
    }

    public function getRoleName()
    {
        return trim($this->role_name);
    }

    public function getRoleActive()
    {
        return (int)$this->role_active;
    }

    public function setRoleId($id)
    {

        $id = (int)$id;
        if ($id < 0) {
            throw new \InvalidArgumentException('Id can\'t be negative');
        }

        $this->role_id = $id;
    }


    public function setRoleName($role_name)
    {


        $this->role_name = trim($role_name);
    }


    public function validation()
    {
        $this->validate(
            new InclusionIn(
                array(
                    "field"  => "role_active",
                    "domain" => array(self::ACTIVE, self::INACTIVE)
                )
            )
        );

        $this->validate(
            new Uniqueness(
                array(
                    "field"   => "role_name",
                    "message" => "The role name must be unique"
                )
            )
        );

        $this->validate(new Regex(array(
            "field" => 'role_name',
            'pattern' => '/^[a-zA-Z0-9\_\-]{3,50}$/',
            "message" => "We only accept letters, numbers, - and _"
        )));

        return $this->validationHasFailed() != true;
    }


}