<?php

use Phalcon\Mvc\Application;

define('APPLICATION_ENV', getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production');

define("START_TIME", microtime(true));

define('APP_PATH', realpath('..'));

define('APPS_PATH', APP_PATH . '/apps');
define('MODULES_PATH', APPS_PATH . '/modules');
define('CORE_PATH', MODULES_PATH . '/core');
define('CONFIG_PATH', APPS_PATH . '/config');
define('VIEWS_PATH', APPS_PATH . '/views');

define('DATA_DIR', APP_PATH . '/data');
define('CACHE_DIR', DATA_DIR . '/cache');


/**
 * TODO move everything to object, because ..... DAAAAHHHHH
 * Maybe EagleCMS :)
 */

try {


    /**
     * Load all the required files
     */
    require_once CONFIG_PATH . '/required_files.php';


    /**
     * Handle the request
     */
    $application = new Application($di);

    /**
     * Include modules
     */
    require CONFIG_PATH . '/load_modules.php';

    /**
     * Include routes
     */
    require CONFIG_PATH . '/routes.php';

    echo $application->handle()->getContent();


} catch (Exception $e) {
    dump($e);
    echo $e->getMessage();
} finally {
    require CONFIG_PATH . '/profiler.php';
}


