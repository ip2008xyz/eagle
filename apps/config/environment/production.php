<?php

return new \Phalcon\Config(array(
    'database' => array(
        'default' => array(
            'adapter' => 'Mysql',
            'host' => 'localhost',
            'username' => 'root',
            'password' => 'password', //
            'dbname' => 'eagle',
            'charset' => 'utf8',
        ),
    ),
    'application' => array(
        'app_name' => 'Eagle - The power of Phalcon',
        'baseUri' => '/',
        'page_404' => '/index/index/page404',
    ),

    'template' => [
        'layouts' => '../../../views/ace/views/layouts/',
        'partials' => [
            'active' => '../../../views/ace/views/partials/active',
            'add' => '../../../views/ace/views/partials/add',
            'edit' => '../../../views/ace/views/partials/edit',
        ],
        'main' => '../../../views/ace/views/index',
    ]

));