<?php



return new \Phalcon\Config(array(
    'database' => array(
        'auth' => array(
            'adapter' => 'Mysql',
            'host' => 'localhost',
            'username' => 'root',
            'password' => 'password',
            'dbname' => 'yona-cms',
            'charset' => 'utf8',
        ),
    ),
    'auth' => [
        'after_login_url' => '/',
        'login_url' => '/auth/index/index',
    ]

));

