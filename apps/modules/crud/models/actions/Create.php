<?php

namespace Eagle\Crud\Models\Actions;

use Eagle\Crud\Models\Action;
use Eagle\Crud\Models\Scanner;

class Create extends Action {


    protected $_namespace = null;

    protected $_name = 'create';


    public function create() {

        $model = \Phalcon\DI::getDefault()->get('project')->getModel($this->_model);
        $form = \Phalcon\DI::getDefault()->get('project')->getForm($this->_form);

        $this->addNamespace($model->getClassName());

        $this->addNamespace($form->getClassName());

        return 'public function ' . Scanner::createVariableName($this->_name) . 'Action()
        {
            try {

                $model = new ' . $model->getDisplayName() . '();

                $form = new ' . $form->getDisplayName() . '($model);

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