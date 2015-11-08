<?php

use Phalcon\Config;

if (!isset($modules)) {
    throw new \Exception('Missing modules');
}


/**
 * first load the files that can be overwriten by the user
 *TODO - have a better ideea
 *
 */

if (is_file(DATA_DIR . '/config/definitions.inc')) {
    require_once DATA_DIR . '/config/definitions.inc';
} else {
    require_once DATA_DIR . '/config/definitions.php';
}

/**
 * Read the configuration for the front end module
 * TODO make env to inherit from production.php
 */


if (!is_file(CONFIG_PATH . '/environment/' . APPLICATION_ENV . '.php')) {
    throw new \Exception('Config file not found');
}

$config = require_once CONFIG_PATH . '/environment/' . APPLICATION_ENV . '.php';

$config = new Config($config);

foreach ($modules as $module_key => $module) {

    $config_file_path = MODULES_PATH . '/' . $module_key . '/config/config.php';

    if (is_file($config_file_path)) {

        $local_config = require_once $config_file_path;


        $local_config = new Config($local_config);
        $config->merge($local_config);


    }

    /**
     * Define Modules install path, MODULE_NAME_PATH, for example CORE_PATH, INDEX_PATH
     */
    $module_define = strtoupper($module_key) . '_PATH';

    if (!defined($module_define)) {
        define($module_define, realpath(MODULES_PATH . '/' . $module_key));
    }
}


