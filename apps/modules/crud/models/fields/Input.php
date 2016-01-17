<?php

namespace Eagle\Crud\Models\Fields;

use Eagle\Crud\Models\Field;

class Input extends Field {

    protected $_namespace = 'Phalcon\Forms\Element\Text';

    public function create() {
        return '$' . $this->getFieldName() . ' = new Text("'. $this->_name . '");';
    }
}