<?php

namespace Eagle\Crud\Models\Filters;

use Eagle\Crud\Models\Filter;

class Trim extends Filter {

    protected $_namespace = null;

    public function create() {
        return "'trim'";
    }
}