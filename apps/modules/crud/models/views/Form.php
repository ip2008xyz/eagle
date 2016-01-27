<?php

namespace Eagle\Crud\Models\Views;


use Eagle\Crud\Models\View;

class Form extends View {


    protected $_namespace = null;

    protected $_name = 'create';


    public function create() {

        return 'echo $form;

\Eagle\Core\Services\Message::write();';

    }
}