<?php
/**
 * Load the debug file
 */
require_once CONFIG_PATH . '/debug.php';

/**
 * Load installed modules
 */
$modules = require_once CONFIG_PATH . "/modules.php";
$modules = $modules + require_once CONFIG_PATH . "/modules.tmp";


/**
 * Load all the configs
 */
require_once CONFIG_PATH . "/load_configs.php";


/**
 * Include general loader
 */
require_once CONFIG_PATH . '/load_loader.php';



/**
 * Include services
 */
require CONFIG_PATH . '/load_services.php';