<?php

return [

    'name' => 'services',
    'table' => 'services',
    'singular' => 'service',
    'access' => 'services_add',
    'route' => 'services/add',

    'columns' => [

        'name' => [

            'type' => 'input',

            'validators' => [
                'min' => 3,
                'max' => 200,
                'required' => true,
            ],

            'filters' => [
                'trim',
            ],
        ],

        'type' => [

            'type' => 'select',

            'validators' => [
                'required' => true,
            ],

            'values' => [
                0 => 'Standard',
                1 => 'Non-Standard',
            ],
            'value' => [
                'emtpy'
            ]
        ]
    ]


];