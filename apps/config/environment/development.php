<?php

return new \Phalcon\Config(array(
    'database' => array(
        'default' => array(
            'adapter' => 'Mysql',
            'host' => 'localhost',
            'username' => 'root',
            'password' => '', //password
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
        'layouts' => '../../common/ace/views/layouts/',
        'partials' => [
            'active' => '../../common/ace/views/partials/active',
            'add' => '../../common/ace/views/partials/add',
            'edit' => '../../common/ace/views/partials/edit',
        ],
        'main' => '../../common/ace/views/index',
    ]

));