<?php
/**
 * Required file to load
 */
use Phalcon\Loader;

$namespaces = array();

foreach($modules as $module_key => $module) {

    $loader_file_path = MODULES_PATH . '/' . $module_key . '/config/loader.php';

    if(is_file($loader_file_path)) {

        require_once $loader_file_path;

        $module_define = strtoupper($module_key) . '_PATH';

        if(!defined($module_define)) {
            define($module_define, realpath(MODULES_PATH . '/' . $module_key));
        }
    }
}

$loader = new Loader();

$loader->registerNamespaces($namespaces);

$loader->register();