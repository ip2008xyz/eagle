<?php

namespace Eagle\Core\Controllers;

use Eagle\Core\Forms\Install;
use Eagle\Core\Models\Modules;
use Eagle\Core\Services\Debug;
use Eagle\Core\Services\Message;

class InstallController extends ControllerBase
{




    public function initialize()
    {
        $this->view->title = $this->config->application->app_name . " :: Install module";


        parent::initialize();
    }




    public function indexAction()
    {
        try {
            $form = new Install();

            if ($this->request->isPost() && $form->isValid($this->request->getPost())) {

                $install = Modules::getInstance();

                if($install->updateModules($form->getValues())) {
                    Message::success("Modules updates");
                }

            }

            $this->view->form = $form;

        } catch (\Exception $e) {
            Message::write_exception($e);
        }
    }

}