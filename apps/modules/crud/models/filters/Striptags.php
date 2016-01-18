<?php

namespace Eagle\Crud\Models\Filters;

use Eagle\Crud\Models\Filter;

class Striptags extends Filter {

    protected $_namespace = null;

    public function create() {
        return "'striptags'";
    }
}