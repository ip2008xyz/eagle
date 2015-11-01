<?php

namespace Eagle\Themes\Controllers;


use Eagle\Core\Services\Message;

use Eagle\Themes\Models\Theme;


class IndexController extends ControllerBase
{

    public function indexAction() {
        try {
            $obj_theme = new Theme();
            $this->view->themes = $obj_theme->getAll();

        } catch(\Exception $e) {
            Message::exception($e);
        }
    }
}

