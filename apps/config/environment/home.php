<?php

return (array(
    'phalcon_command' => '/opt/phalcon-tools/phalcon.php', //path to phalcon.php or phalcon command
    'database' => array(
        'default' => array(
            'adapter' => 'Mysql',
            'host' => 'localhost',
            'username' => 'mysql_user',
            'password' => 'password',
            'dbname' => 'eagle',
            'charset' => 'utf8',
        ),
    ),

    'template' => [
        'admin' => [
            'name' => ADMIN_THEME,
            'layouts' => '../../../views/' . ADMIN_THEME . '/views/layouts/',
            'partials' => [
                'active' => '../../../views/' . ADMIN_THEME . '/views/partials/active',
                'add' => '../../../views/' . ADMIN_THEME . '/views/partials/add',
                'edit' => '../../../views/' . ADMIN_THEME . '/views/partials/edit',
            ],
            'main' => '../../../views/' . ADMIN_THEME . '/views/index',
        ],

        'front' => [
            'name' => FRONT_THEME,
            'layouts' => '../../../views/' . FRONT_THEME . '/views/layouts/',
            'partials' => [
                'active' => '../../../views/' . FRONT_THEME . '/views/partials/active',
                'add' => '../../../views/' . FRONT_THEME . '/views/partials/add',
                'edit' => '../../../views/' . FRONT_THEME . '/views/partials/edit',
            ],
            'main' => '../../../views/' . FRONT_THEME . '/views/index',
        ]
    ]
));