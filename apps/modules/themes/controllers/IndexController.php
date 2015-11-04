<?php

namespace Eagle\Themes\Controllers;


use Eagle\Core\Services\Message;
use Eagle\Themes\Forms\Themes;
use Eagle\Themes\Models\Theme;


class IndexController extends ControllerBase
{

    public function indexAction()
    {
        try {

            //$obj_theme = new Theme();

            //$this->view->themes = $obj_theme->getAll();

            $form = new Themes();
            if ($this->request->isPost() && $form->isValid($this->request->getPost())) {

                prdie($form->getValues());

            }
            $this->view->form = $form;


        } catch (\Exception $e) {
            Message::exception($e);
        }
    }
}

