<?php


use Phalcon\Db\Profiler as DbProfiler;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Session\Adapter\Files as SessionAdapter;


/**
 * Registering a router
 */
$di->setShared('router', function () {

    $router = new Router();

    $router->setDefaultModule('index');

    $router->setDefaultNamespace('Eagle\Index\Controllers');

    //$router->notFound(['module' => 'index', 'controller' => 'index', 'action' => 'page404']);

    return $router;

});


/**
 * The URL component is used to generate all kinds of URLs in the application
 */
$di->setShared('url', function () use ($config) {

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});


/**
 * Setting up the view component
 */
$di->setShared('view', function () use ($config) {

    $view = new View();
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.volt' => function ($view, $di) use ($config) {

            $volt = new VoltEngine($view, $di);

            $volt->setOptions(array(
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ));

            return $volt;
        },
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ));

    return $view;
});


$di->set('profiler', function () {
    return new DbProfiler();
}, true);


/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db_default', function () use ($config, $di) {

    $dbConfig = $config->database->default->toArray();

    $adapter = $dbConfig['adapter'];

    unset($dbConfig['adapter']);

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;

    $eventsManager = new EventsManager();

    // Get a shared instance of the DbProfiler
    $profiler = $di->getProfiler();

    // Listen all the database events
    $eventsManager->attach('db', function ($event, $connection) use ($profiler) {
        if ($event->getType() == 'beforeQuery') {
            // Start a profile with the active connection

            $profiler->startProfile($connection->getSQLStatement());
        }
        if ($event->getType() == 'afterQuery') {
            // Stop the active profile
            $profiler->stopProfile();

        }
    });

    $connection = new $class($dbConfig);

    // Assign the events manager to the connection
    $connection->setEventsManager($eventsManager);


    return $connection;
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
//$di->setShared('modelsMetadata', function () {
/**
 * TODO: find out why this is required to access db or models ??
 */
//   return new MetaDataAdapter();
//});


/**
 * Starts the session the first time some component requests the session service
 */
$di->setShared('session', function () {

    $session = new SessionAdapter();
    $session->start();

    return $session;
});

/**
 * Set the default namespace for dispatcher
 */
$di->setShared('dispatcher', function () use ($di) {

    // Create an EventsManager
    $eventsManager = new EventsManager();

    // Attach a listener
    $eventsManager->attach("dispatch:beforeDispatchLoop", function ($event, $dispatcher) {
        /**
         * TODO: should put this only for admin or admin base modules
         */
        $keyParams = array();
        $params = $dispatcher->getParams();

        // Use odd parameters as keys and even as values
        foreach ($params as $number => $value) {
            if ($number & 1) {
                $keyParams[$params[$number - 1]] = $value;
            }
        }

        // Override parameters
        $dispatcher->setParams($keyParams);

    });

    $eventsManager->attach('dispatch:beforeException', function ($event, $dispatcher, $exception) {
        switch ($exception->getCode()) {
            case \Phalcon\Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
            case \Phalcon\Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                $dispatcher->forward(array(
                    'module' => 'index',
                    'controller' => 'index',
                    'action' => 'page404',
                ));

                return false;
        }
    });


    /**
     * TODO - implement dispatch:beforeException
     */

    $dispatcher = new Phalcon\Mvc\Dispatcher();
    $dispatcher->setEventsManager($eventsManager);
    $dispatcher->setDefaultNamespace('Eagle\Index\Controllers');

    return $dispatcher;
});