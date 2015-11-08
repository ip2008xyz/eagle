<?php


function routes_install($di = null) {
    $di->get('db_default')->insert("menus", array(null, 'Admin', 'Routes', 2, 5, '/routes', 'routes_index_index', 1, 1, 'desktop'));

    $di->get('db_default')->insert("permissions", array(null, "Routes", 'routes_*_*', 1));

    $permission_id = $di->get('db_default')->lastInsertId();

    $di->get('db_default')->insert("roles_permissions",array(1, $permission_id));
}

function routes_uninstall($di = null) {
    $di->get('db_default')->delete("menus", 'menu_permission = "routes_index_index"');
    $di->get('db_default')->delete("permissions", 'permission_mca = "routes_*_*"');
}