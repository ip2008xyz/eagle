<?php

namespace Eagle\Menus\Controllers;

use Eagle\Core\Controllers\ControllerBase as BaseCoreController;


class ControllerBase extends BaseCoreController {

/** Use the default base controller of the core module */
    public function initialize() {

        $this->view->setLayoutsDir('../../core/views/layouts/');
        $this->view->setLayout('index');

        $this->view->setMainView('../../core/views/index');

        $this->view->title = "Page title";

        parent::initialize();
    }
}
