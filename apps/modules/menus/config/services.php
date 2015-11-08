<?php

use Eagle\Menus\Models\Menus;

$di->getShared('dispatcher')->getEventsManager()->attach("dispatch:afterExecuteRoute", function ($event, $dispatcher) use ($di) {

    /**
     * TODO find a way to get the path from real path
     */

    /**
     * TODO replace this with the route of finding out the real menu
     */

    ob_start();

    $obj_menu = new Menus();
    $di->get('view')->partial('../../menus/views/partials/admin_menu', ['menus' => $obj_menu->getMenus($di->get('view')->view_theme_type)]);
    $di->get('view')->view_sidebar_menu = ob_get_contents();

    ob_end_clean();

});


