<?php
namespace Eagle\Menus\Forms;

use Eagle\Core\Forms\Form;
use Phalcon\Filter;
use Phalcon\Forms\Element\Hidden;

use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Text;


class Menu extends Form
{
    public function initialize()
    {
        $this->setAction($this->acl->getURL());

        $menu_id = new Hidden("menu_id");

        $menu_name = new Text("menu_name");
        $menu_name->setLabel('Name')
            ->addFilter('trim')
            ->addFilter('striptags');

        $menu_link = new Text("menu_link");
        $menu_link->setLabel('Link')
            ->addFilter('trim')
            ->addFilter('striptags');

        $menu_permission = new Text("menu_permission");
        $menu_permission->setLabel('Permission')
            ->addFilter('trim')
            ->addFilter('striptags');

        $this->add($menu_id);
        $this->add($menu_name);
        $this->add($menu_link);
        $this->add($menu_permission);

    }

    public function addNewElements()
    {
        $menu_group = new Text("menu_group");
        $menu_group->setLabel('Group')
            ->addFilter('trim')
            ->addFilter('striptags');



        $this->add($menu_group, 'menu_name');


    }


}