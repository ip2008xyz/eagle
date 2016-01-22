<?php

namespace Eagle\Crud\Models\Actions;

use Eagle\Crud\Models\Action;
use Eagle\Crud\Models\Scanner;

class Create extends Action {


    protected $_namespace = null;

    protected $_name = 'create';


    public function create() {


        return 'public function ' . Scanner::createVariableName($this->_name) . 'Action()
        {
            try {

                $model = new ' . Scanner::createVariableName($this->_model) . '();

                $form = new ' . Scanner::createVariableName($this->_form) . '($model);

                if ($this->request->isPost() && $form->isValid($this->request->getPost())) {

                    $model->save();

                }

                $this->view->form = $form;


            } catch (\Exception $e) {
                Message::exception($e);
            }
        }';

    }
}