<?php
/**
 * Load the debug file
 */
require_once CONFIG_PATH . '/debug.php';



/**
 * Read the configuration for the front end module
 * TODO make variable to load the env file base based on the server
 */

$config = require_once CONFIG_PATH . "/environment/production.php";




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