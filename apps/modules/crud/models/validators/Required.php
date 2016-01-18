<?php

namespace Eagle\Crud\Models\Validators;

use Eagle\Crud\Models\Validator;

class Required extends Validator {

    protected $_namespace = 'Phalcon\Forms\Element\Text';

    public function create() {

        return " new Between([
                    'minimum' => " . $this->getValue()
        . "   ])";
    }
}