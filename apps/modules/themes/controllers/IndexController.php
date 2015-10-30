<?php

namespace Eagle\Routes\Controllers;

use Eagle\Auth\Forms\Login;
use Eagle\Core\Services\Message;


class IndexController extends ControllerBase
{

    public function indexAction() {
        try {

        } catch(\Exception $e) {
            Message::exception($e);
        }
    }
}

