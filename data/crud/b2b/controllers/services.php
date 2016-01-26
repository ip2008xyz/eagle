<?php


return [
    'name' => 'Services',
    'objectName' => 'Eagle\Crud\Models\Controller',

    'actions' => [
        [
            'type' => 'create',
            'form' => 'service',
            'model' => 'services',
            'name'  => 'create',
        ],

       /* [
            'type' => 'read',
            'url' => 'services',
            'access' => 'b2b_services_view',
            'view' => [
                'type' => 'table',
                'columns' => [
                    'id' => 'ID',
                    'name' => 'Name',
                ]
            ],
        ],*/

    ],
];