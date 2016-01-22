<?php

return [
    'objectName' => 'Eagle\Crud\Models\Model',

    'table' => 'services',
    'name'  => 'Services',
    'singular' => 'service',

    'columns' => [
        'id' => 'int',
        'name' => 'varchar',
        'type' => 'int', //1 - standard, 2 - non-standard
    ],
];