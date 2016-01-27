<?php

namespace Eagle\B2B\Controllers;

use Eagle\Core\Services\Message;
use Eagle\B2B\Models\Services;
use Eagle\B2B\Forms\Service;


class ServicesController extends ControllerBase
{


    public function initialize() {
        

    }


    public function createAction()
        {
            try {

                $model = new Services();

                $form = new Service($model);

                if ($this->request->isPost() && $form->isValid($this->request->getPost())) {

                    $model->save();

                }

                $this->view->form = $form;


            } catch (\Exception $e) {
                Message::exception($e);
            }
        }

}

