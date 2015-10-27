<?php

namespace Eagle\Index\Controllers;

class IndexController extends ControllerBase
{

    public function initialize() {

    }
    public function indexAction()
    {

    }

    public function page404Action()
    {
        $this->view->title = '404';
        $this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');

        //$this->view->setLayout('index');

        $this->response->setHeader('HTTP/1.0 404','Not Found');
    }

}

