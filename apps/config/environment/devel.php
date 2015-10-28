<?php

return (array(
    'database' => array(
        'default' => array(
            'adapter' => 'Mysql',
            'host' => 'localhost',
            'username' => 'root',
            'password' => 'password',
            'dbname' => 'eagle',
            'charset' => 'utf8',
        ),
    ),

    'template' => [
        'admin' => [
            'name' => 'Ace',
            'layouts' => '../../../views/ace/views/layouts/',
            'partials' => [
                'active' => '../../../views/ace/views/partials/active',
                'add' => '../../../views/ace/views/partials/add',
                'edit' => '../../../views/ace/views/partials/edit',
            ],
            'main' => '../../../views/ace/views/index',
        ],
        'front' => [
            'name' => 'Bootstrap',
            'layouts' => '../../../views/bootstrap/views/layouts/',
            'partials' => [
                'active' => '../../../views/bootstrap/views/partials/active',
                'add' => '../../../views/bootstrap/views/partials/add',
                'edit' => '../../../views/bootstrap/views/partials/edit',
            ],
            'main' => '../../../views/bootstrap/views/index',
        ]
    ]

));