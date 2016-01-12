<?php


function crud_install($di = null) {
    //id group name level order link permission pid active icon
    $di->get('db_default')->insert("menus", array(null, 'Admin', 'CRUD', 2, 5, '/crud', 'crud_index_index', 1, 1, 'desktop'));
    $di->get('db_default')->insert("permissions", array(null, "CRUD", 'crud_*_*', 1));
    $permission_id = $di->get('db_default')->lastInsertId();
    $di->get('db_default')->insert("roles_permissions",array(1, $permission_id));
}

function crud_uninstall($di = null) {
    $di->get('db_default')->delete("menus", 'menu_permission = "crud_index_index"');
    $di->get('db_default')->delete("permissions", 'permission_mca = "crud_*_*"');
}