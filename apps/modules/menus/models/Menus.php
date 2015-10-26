<?php
namespace Eagle\Menus\Models;

use Phalcon\Mvc\Model;

class Menus extends Model
{

    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $_childrens = null;

    public function initialize()
    {

        $this->setConnectionService('db_default');
        $this->setSource("menus");

        $this->hasMany('menu_id', 'Eagle\Menus\Models\Menus', 'menu_pid', array('alias' => 'leafs'));
        $this->belongsTo('menu_pid', 'Eagle\Menus\Models\Menus', 'menu_id', array('alias' => 'parent'));
    }

    public static function orderMenus($order, $pid = null)
    {
        foreach ($order as $menu_order => $values) {
            $menu = Menus::findFirst($values['id']);
            $menu->menu_order = $menu_order;
            $menu->menu_pid = $pid;
            $menu->save();
            if (isset($values['children']) && count($values['children']) > 0) {
                Menus::orderMenus($values['children'], $values['id']);
            }
        }
        return true;
    }


    public function getSource()
    {
        return 'menus';
    }

    /**
     * Get a multidimension array of all menu groups
     * @return array
     */
    public static function getAll()
    {
        $tmp_groups = Menus::getGroups();
        $menus = array();

        foreach ($tmp_groups as $group) {
            $menus[$group->menu_group] = $group->getMenus($group->menu_group);

        }


        return $menus;
    }

    /**
     * Returns a list of all the groups
     * @return \Eagle\Menus\Models\Menus
     */
    public static function getGroups()
    {
        return Menus::find(
            [
                'menu_pid IS NULL',
                'group' => 'menu_group',
            ]
        );
    }

    /**
     * Get a multidimension array of the menu for a group or for current pid
     * @return array
     */
    public function getMenus($menu_group = null)
    {


        if (!is_null($menu_group)) {
            $menus = Menus::find(
                [
                    'menu_pid IS NULL AND menu_group = :menu_group:',
                    'bind' => [
                        'menu_group' => $menu_group,
                    ],
                ]
            );
        } else {
            $menus = Menus::find(
                [
                    'menu_pid =  :menu_pid:',
                    'bind' => [
                        'menu_pid' => $this->menu_id,
                    ],
                ]
            );
        }

        if ($menus) {
            $tmp_menus = array();
            foreach ($menus as $menu) {
                $tmp_menus[$menu->menu_id] = $menu->toArray();
                $tmp_menus[$menu->menu_id]['submenu'] = $menu->getMenus();


            }
            return $tmp_menus;
        }
        return null;


    }

    public function setChildrens($data)
    {
        $this->_childrens = $data;
    }

    public function getChildrens()
    {
        return $this->_childrens;
    }


    public function addNewMenu($pid, $type = '')
    {
        if (is_numeric($pid)) {
            $pid = Menus::findFirst($pid);
        }

        if ($type === 'same') {
            $this->menu_group = $pid->menu_group;
            $this->menu_level = $pid->menu_level;
            $this->menu_pid = $pid->menu_pid;
            $this->menu_active = Menus::ACTIVE;

        } elseif ($type === 'under') {
            $this->menu_group = $pid->menu_group;
            $this->menu_level = $pid->menu_level + 1;
            $this->menu_pid = $pid->menu_id;
            $this->menu_active = Menus::ACTIVE;
        }

        return $this->save();


    }


}