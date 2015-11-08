<?php


function themes_install($di = null) {
    $di->get('db_default')->insert("menus", array(null, 'Admin', 'Themes', 2, 4, '/themes', 'themes_index_index', 1, 1, 'desktop'));

    $di->get('db_default')->insert("permissions", array(null, "Themes", 'themes_index_*', 1));

    $permission_id = $di->get('db_default')->lastInsertId();

    $di->get('db_default')->insert("roles_permissions",array(1, $permission_id));
}


function themes_uninstall($di = null) {

    $di->get('db_default')->delete("menus", 'menu_permission = "themes_index_index"');
    $di->get('db_default')->delete("permissions", 'permission_mca = "themes_index_*"');

}