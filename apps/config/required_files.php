<?php
/**
 * Load the debug file
 */
require_once CONFIG_PATH . '/debug.php';



/**
 * Read the configuration for the front end module
 * TODO make env to inherit from production.php
 */
if(!is_file(CONFIG_PATH . '/environment/' . APPLICATION_ENV . '.php')) {
    throw new \Exception('Config file not found');
}

$config = require_once CONFIG_PATH . '/environment/' . APPLICATION_ENV . '.php';




/**
 * Load installed modules
 */
$modules = require_once CONFIG_PATH . "/modules.php";



/**
 * Include general loader
 */
require_once CONFIG_PATH . '/loader.php';



/**
 * Include services
 */
require CONFIG_PATH . '/services.php';