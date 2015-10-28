<?php

namespace Eagle\Index\Controllers;

class IndexController extends ControllerBase
{


    public function indexAction()
    {

    }

    public function page404Action()
    {
        $this->view->title = '404';

        $this->response->setHeader('HTTP/1.0 404','Not Found');
    }

}

