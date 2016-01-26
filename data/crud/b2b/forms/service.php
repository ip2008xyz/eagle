<?php

return [

    'objectName' => 'Eagle\Crud\Models\Form',

    'name' => 'service',
    'model' => 'service',

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
                'trim', 'striptags',
            ],
        ],

        [
            'name' => 'Type',
            'type' => 'select',

            'validators' => [
                'required' => true,
            ],

            'options' => [
                0 => 'Standard',
                1 => 'Non-Standard',
            ],
            'value' => [
                'emtpy'
            ]
        ],
        [
            'name' => 'Save',
            'type' => 'submit',

        ]
    ]


];