<?php

namespace Eagle\Crud\Models\Fields;

use Eagle\Crud\Models\Field;

class Select extends Field
{

    protected $_namespace = 'Phalcon\Forms\Element\Select';

    public function create()
    {
        return '$' . $this->getFieldName() . ' = new Select("' . $this->_name . '");';
    }

}