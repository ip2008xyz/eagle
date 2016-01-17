<?php

return [

    'objectName' => 'Eagle\Crud\Models\Form',

    'name' => 'services',
    'model' => 'Services',

    'fields' => [

        [
            'name' => 'Name',
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

        [
            'name' => 'Type',
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