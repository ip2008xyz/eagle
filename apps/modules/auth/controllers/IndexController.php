<?php

namespace Eagle\Auth\Controllers;

use Eagle\Auth\Forms\Login;
use Eagle\Core\Services\Message;


class IndexController extends ControllerBase
{

    /**
     * DO NOT USE THE DEFAULT ADMIN TEMPLATE
     */
    public function initialize() {

        $this->view->title = "Page title";


        // Add some local CSS resources
        $this->assets
            ->addCss('assets/css/bootstrap.css')
            ->addCss('assets/css/font-awesome.css')
            ->addCss('assets/css/ace-fonts.css')
            ->addCss('assets/css/ace.css')
            ->addCss('assets/css/ace-rtl.css')
            ->addCss('css/main.css');

        // And some local JavaScript resources
        $this->assets
            ->addJs('assets/js/jquery.js')
            ->addJs('assets/js/bootstrap.js');
    }


    public function indexAction()
    {
        try {
            if ($this->auth->isAuth()) {
                return $this->response->redirect($this->auth->getAfterLoginUrl())->send();
            }

            $form = new Login();

            if ($this->request->isPost()) {

                if ($form->isValid($this->request->getPost())) {

                    $auth = $this->auth->authUser($form->getValues());

                    if ($auth === true) {
                        return $this->response->redirect($this->auth->getAfterLoginUrl())->send();
                    } else {

                        Message::error($auth);
                    }

                }
            }
            $this->view->form = $form;
        } catch (\Exception $e) {
            Message::exception($e);
        }
    }

    public function exitAction()
    {
        try {
            $this->auth->logoutUser();
            return $this->response->redirect($this->auth->getAfterLoginUrl())->send();
        } catch (\Exception $e) {
            Message::write_exception($e);
        }
    }

}

