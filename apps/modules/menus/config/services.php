<?php

use Eagle\Menus\Models\Menus;

$di->getShared('dispatcher')->getEventsManager()->attach("dispatch:afterExecuteRoute", function ($event, $dispatcher) use ($di) {

    /**
     * TODO replace this with the route of finding out the real menu
     */
    $obj_menu = new Menus();

    /**
     * TODO find a way to get the path from real path
     */
    $di->get('view')->view_menu_sidebar = $di->get('view')->getPartial('../../menus/views/partials/admin_menu', ['menus' => $obj_menu->getMenus('Admin')]);


});


