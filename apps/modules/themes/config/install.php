<?php


function themes_install($di = null) {
   $di->get('db_default')->insert("menus", array(null, 'Admin', 'Themes', 2, 4, '/themes', 'themes_index_index', 1, 1, 'desktop'));
}

function themes_uninstall($di = null) {
    $di->get('db_default')->delete("menus", 'menu_permission = "themes_index_index"');
}