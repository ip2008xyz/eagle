<?php

namespace Eagle\Crud\Models\Validators;

use Eagle\Crud\Models\Validator;

class Min extends Validator {

    protected $_namespace = 'Phalcon\Validation\Validator\Between';

    public function create() {

        return " new Between([
                    'minimum' => " . $this->getValue()
             . "   ])";
    }
}