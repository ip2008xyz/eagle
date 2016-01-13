<?php

namespace Eagle\Crud\Controllers;

use Eagle\Crud\Models\Form;
use Eagle\Core\Services\Message;
use Eagle\Crud\Models\Crud;


class IndexController extends ControllerBase
{

    public function indexAction()
    {
        try {

            $crud = new Crud();

            $this->view->crud_files = $crud->getAll($this->config->crud->dir->form);



        } catch (\Exception $e) {
            Message::exception($e);
        }
    }

    public function createAction($file_name = '') {
        if(is_file($this->config->crud->dir->form . '/' . $file_name . '.php')) {

            $obj = new Form($this->config->crud->dir->form . '/' . $file_name . '.php');
            var_dump($obj->getFields());
            exit();
            foreach($obj->getFields() as $v) {

            }
        }
    }
}

