<?php

namespace Eagle\Themes\Controllers;


use Eagle\Core\Services\Message;
use Eagle\Themes\Forms\Themes;
use Eagle\Themes\Models\Theme;


class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $form = null;

        try {


            $obj_theme = new Theme();

            $form = new Themes();

            $form->setThemes($obj_theme->getAll())->createElements();

            if ($this->request->isPost() && $form->isValid($this->request->getPost())) {


                $obj_theme->storeThemes($form->getValues());
                //$input = prdie($form->getValues());

            }



        } catch (\Exception $e) {
            Message::exception($e);
        } finally {
            $this->view->form = $form;
        }
    }
    
}

