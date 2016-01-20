<?php

namespace Eagle\Crud\Models\Validators;

use Eagle\Crud\Models\Validator;

class Required extends Validator {

    protected $_namespace = 'Phalcon\Validation\Validator\PresenceOf';

    public function create() {

        return 'new PresenceOf()';
    }
}