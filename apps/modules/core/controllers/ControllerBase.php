<?php

namespace Eagle\Core\Controllers;

use Phalcon\Mvc\Controller as PhController;
use Phalcon\Mvc\View;

class ControllerBase extends PhController
{

    public function initialize()
    {

        $this->view->view_menu_sidebar = '';

        $this->view->setLayoutsDir($this->config->template->admin->layouts);
        $this->view->setLayout('index');

        $this->view->setMainView($this->config->template->admin->main);

        $this->view->setLayout('index');

        // Add some local CSS resources
        $this->assets
            ->addCss('assets/css/bootstrap.css')
            ->addCss('assets/css/font-awesome.css')
            ->addCss('assets/css/jquery.gritter.css')
            ->addCss('assets/css/ace-fonts.css')
            ->addCss('assets/css/ace.css')
            ->addCss('assets/css/ace-rtl.css')
            ->addCss('css/main.css');

        // And some local JavaScript resources
        $this->assets
            ->addJs('assets/js/jquery.js')
            ->addJs('assets/js/bootstrap.js')
            ->addJs('assets/js/jquery-ui.js')
            ->addJs('assets/js/ace-elements.js')
            ->addJs('assets/js/ace.js')
            ->addJs('assets/js/ace/ace.sidebar.js')
            ->addJs('assets/js/jquery.gritter.js')
            ->addJs('js/trigger.js')
            ->addJs('js/ready.js');

        if ($this->request->isAjax()) {
            $this->view->disableLevel(View::LEVEL_MAIN_LAYOUT);
            //change level layout to ajax
            $this->view->setLayout('ajax');

        }
    }
}
