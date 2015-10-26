<?php

use Phalcon\Di\FactoryDefault;


/**
 * Services are globally registered in this file
 *
 * @var \Phalcon\Config $config
 */

/**
 * The FactoryDefault Dependency Injector automatically registers the right services to provide a full stack framework
 */
$di = new FactoryDefault();

/**
 * Register the config
 */
$di->set('config', $config);


/**
 * Register the installed modules
 */
$di->set('modules', (object) $modules);

/**
 * Load all services for the installed modules
 */

foreach($modules as $module_key => $module) {

    $service_file_path = MODULES_PATH . '/' . $module_key . '/config/services.php';

    if(is_file($service_file_path)) {


        require_once $service_file_path;
    }
}

