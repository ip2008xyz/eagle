<?php

namespace Eagle\B2b\Controllers;

use Eagle\Core\Services\Message;



class ServicesController extends ControllerBase
{


    public function initialize() {
        

    }


    public function createAction()
        {
            try {

                $model = new Services();

                $form = new Services($model);

                if ($this->request->isPost() && $form->isValid($this->request->getPost())) {

                    $model->save();

                }

                $this->view->form = $form;


            } catch (\Exception $e) {
                Message::exception($e);
            }
        }

}

