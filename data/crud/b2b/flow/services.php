<?php


return [
    'project' => 'b2b',
    'pages' => [
        [
            'type' => 'add',
            'url' => 'services/add',
            'access' => 'b2b_services_add',
            'form' => [
                'form' => 'services',
            ],
        ],

        [
            'type' => 'view',
            'url' => 'services',
            'access' => 'b2b_services_view',
            'view' => [
                'type' => 'table',
                'columns' => [
                    'id' => 'ID',
                    'name' => 'Name',
                ]
            ],
        ],

    ],
];