<?php

namespace Eagle\Crud\Models\Validators;

use Eagle\Crud\Models\Validator;


class Max extends Validator
{

    protected $_namespace = 'Phalcon\Validation\Validator\Between';

    public function create()
    {

        return 'new Between([' . "\n"
        . "   'minimum' => " . $this->getValue() . "\n"
        . '])';

    }
}