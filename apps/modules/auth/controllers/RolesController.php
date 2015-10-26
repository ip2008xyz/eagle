<?php

namespace Eagle\Auth\Controllers;


use Eagle\Auth\Forms\Role;
use Eagle\Auth\Models\Roles;
use Eagle\Core\Services\Message;

class RolesController extends ControllerBase
{

    public function indexAction()
    {
        try {
            $this->view->roles = Roles::find();

        } catch (\Exception $e) {
            Message::exception($e);
        }
    }

    public function liveAction()
    {
        try {

            $role_id = (int)$this->dispatcher->getParam('id');

            if (Roles::changeActive($role_id)) {
                Message::success("Role status updated");
            } else {
                Message::warning("Role not updated");
            }

        } catch (\Exception $e) {
            Message::exception($e);
        }
    }

    public function addAction()
    {
        try {


            $role = new Roles();

            $form = new Role($role);

            if ($this->request->isPost() && $form->isValid($this->request->getPost())) {

                $role->save();

            }

            $this->view->form = $form;


        } catch (\Exception $e) {
            Message::exception($e);
        }
    }

    public function editAction()
    {
        try {

            $role_id = (int)$this->dispatcher->getParam('id');

            $role = Roles::findFirst($role_id);
            if(!$role) {
                throw new \Exception("Role not found");
            }

            $form = new Role($role);
            $form->setAction($this->acl->getURL() . '/id/' . $role->role_id);

            if ($this->request->isPost() && $form->isValid($this->request->getPost())) {
                $role->save();
            }

            $this->view->form = $form;


        } catch (\Exception $e) {
            Message::exception($e);
        }
    }


}

