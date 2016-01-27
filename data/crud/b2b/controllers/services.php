<?php


return [
    'name' => 'Services',
    'objectName' => 'Eagle\Crud\Models\Controller',

    'actions' => [
        [
            'name' => 'create',
            'type' => 'create',
            'form' => 'service',
            'model' => 'services',


        ],
    ],
    'views' => [ //TODO fix this, the relation should not be on numerical keys
        [
            'name' => 'create',
            'type' => 'form',
        ],
    ]

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


];