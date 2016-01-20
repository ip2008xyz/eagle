<?php

namespace Eagle\Crud\Models\Fields;

use Eagle\Crud\Models\Field;

class Submit extends Field {

    protected $_namespace = 'Phalcon\Forms\Element\Submit';

    public function create() {
        return '$' . $this->getFieldName() . ' = new Submit("'. $this->_name . '");';
    }
}