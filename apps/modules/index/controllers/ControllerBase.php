<?php

namespace Eagle\Index\Controllers;

use Eagle\Core\Controllers\ControllerBase as Controller;

class ControllerBase extends Controller
{

    public function initialize() {

        $this->view->title = $this->config->application->app_name;

        $this->assets->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');

        $this->view->setLayoutsDir($this->config->template->front->layouts);

        $this->view->setLayout('index');

        $this->view->setMainView($this->config->template->front->main);

        $this->view->setLayout('index');



    }
}
