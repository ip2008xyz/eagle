<?php

use \Phalcon\Config;

if(!isset($modules)) {
    throw new \Exception('Missing modules');
}


/**
 * Read the configuration for the front end module
 * TODO make env to inherit from production.php
 */
if(!is_file(CONFIG_PATH . '/environment/' . APPLICATION_ENV . '.php')) {
    throw new \Exception('Config file not found');
}

$config = require_once CONFIG_PATH . '/environment/' . APPLICATION_ENV . '.php';

foreach($modules as $module_key => $module) {

    $config_file_path = MODULES_PATH . '/' . $module_key . '/config/config.php';

    if(is_file($config_file_path)) {

        $local_config = require_once $config_file_path;
        $config = array_merge($config, $local_config);

    }
}

$config = new Config($config);

