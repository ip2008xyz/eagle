<?php

return [
    'table' => 'services',

    'singular' => 'service',

    'columns' => [
        'id' => 'int',
        'name' => 'varchar',
        'type' => 'int', //1 - standard, 2 - non-standard
    ],
];