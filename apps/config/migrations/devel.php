<?php
/**
 * TODO make this based on enviroment from htaccess
 */
return new \Phalcon\Config(array(
    'database' => array(

            'adapter' => 'Mysql',
            'host' => 'localhost',
            'username' => 'root', //mysql_user
            'password' => '',
            'dbname' => 'eagle',
            'charset' => 'utf8',

    ),

));