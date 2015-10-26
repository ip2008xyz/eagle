<?php

namespace Eagle\Auth;

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\ModuleDefinitionInterface;


class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {

        $loader = new Loader();

        $loader->registerNamespaces(array(
            'Eagle\Auth\Controllers' => __DIR__ . '/controllers/',
            'Eagle\Auth\Models' => __DIR__ . '/models/',
            'Eagle\Auth\Forms' => __DIR__ . '/forms/',
        ));

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        $config = $di->get('config');


        /**
         * Read configuration
         */
        $local_config = include MODULES_PATH . "/auth/config/config.php";
        $config->merge($local_config);
        $config = $di->get('config');

        /**
         * Setting up the view component
         */
        $di['view'] = function () {
            $view = new View();
            $view->setViewsDir(__DIR__ . '/views/');

            return $view;
        };

        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        //$di['db'] = function () use ($config) {
        //    return new DbAdapter($config->toArray());
        //};
    }
}
