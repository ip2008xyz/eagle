<?php 
return [ 
    'core' => [
        'priority' => 0,
        'name' => 'Core',
        'description' => 'Do not disable this module',
        'namespace' => '\Eagle\Core',
        'group' => 'Core',
        'version' => 0.1,
    ],
    'index' => [
        'priority' => 1,
        'name' => 'Index',
        'description' => 'Do not disable this module',
        'namespace' => '\Eagle\Index',
        'group' => 'Core',
        'version' => 0.1,
    ],
    'auth' => [
        'priority' => 100,
        'name' => 'Auth',
        'description' => 'The auth module',
        'namespace' => '\Eagle\Auth',
        'group' => 'Auth',
        'version' => 0.1,
    ],
    'menus' => [
        'priority' => 101,
        'name' => 'Menus',
        'description' => 'The menus module',
        'namespace' => '\Eagle\Menus',
        'group' => 'Menus',
        'version' => 0.1,
        'require' => [
            '0' => 'auth',
        ],
    ],
    'themes' => [
        'priority' => 103,
        'name' => 'Themes',
        'description' => 'The theming modules',
        'namespace' => '\Eagle\Themes',
        'group' => 'Themes',
        'version' => 0.1,
        'require' => [

        ],
    ],
]; 