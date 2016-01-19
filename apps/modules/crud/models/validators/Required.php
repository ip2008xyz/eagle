<?php

namespace Eagle\Crud\Models\Validators;

use Eagle\Crud\Models\Validator;

class Required extends Validator {

    protected $_namespace = null;

    public function create() {

        return 'new Between([' . "\n"
        . "   'minimum' => " . $this->getValue() . "\n"
        . '])';
    }
}