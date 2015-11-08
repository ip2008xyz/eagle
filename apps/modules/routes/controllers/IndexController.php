<?php

namespace Eagle\Routes\Controllers;

use Eagle\Core\Services\Message;
use Eagle\Routes\Models\Routes;


class IndexController extends ControllerBase
{


    public function indexAction()
    {
        try {

            $this->view->routes = Routes::getAll()->toarray();


        } catch (\Exception $e) {
            Message::exception($e);
        }
    }
}

