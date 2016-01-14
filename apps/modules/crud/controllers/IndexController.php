<?php

namespace Eagle\Crud\Controllers;

use Eagle\Crud\Models\Form;
use Eagle\Core\Services\Message;
use Eagle\Crud\Models\Crud;
use Eagle\Crud\Models\Project;


class IndexController extends ControllerBase
{

    public function indexAction()
    {
        try {

            $this->view->crud_project = new Project([
                'path' => $this->config->crud->dir,
                'name' => 'b2b',
            ]);


        } catch (\Exception $e) {
            Message::exception($e);
        }
    }

    public function createAction($project_name = '')
    {

        $project = new Project([
                'path' => $this->config->crud->dir,
                'name' => $project_name,
            ]);

        $project->load()->create();

    }
}

