<?php


use Eagle\Auth\Models\Acl;
use Eagle\Auth\Models\Auth;

//'Eagle\Auth\Models' => APPS_PATH . '/auth/models/',

/**
 * Custom authentication component
 */
$di->set('auth', function () {
    return new Auth();
});


/**
 * Access Control List
 */
$di->set('acl', function () {

    $acl = new Acl();

    return $acl;

});




$di->getShared('dispatcher')->getEventsManager()->attach("dispatch:beforeExecuteRoute", function ($event, $dispatcher) use ($di) {

    $moduleName = $dispatcher->getModuleName();

    $controllerName = $dispatcher->getControllerName();

    $actionName = $dispatcher->getActionName();


    $di->getShared('acl')->setModule($moduleName);

    $di->getShared('acl')->setController($controllerName);

    $di->getShared('acl')->setAction($actionName);

    if ($di->get('acl')->isAllowed($moduleName, $controllerName, $actionName) == Acl::ALLOW) {
        //we are good, do nothing here

        return true;

    } else {

        $di->get('response')->redirect($di->get('config')->application->page_404)->send();
        return false;
    }
});

