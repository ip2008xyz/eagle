<?php

namespace Eagle\Menus\Controllers;

use Eagle\Menus\Forms\Menu;
use Eagle\Core\Services\Message;
use Eagle\Menus\Models\Menus;
use Phalcon\Annotations\Exception;


class IndexController extends ControllerBase
{

    public function addAction()
    {
        try {


            $type = trim($this->dispatcher->getParam('type'));
            $pid = (int)$this->dispatcher->getParam('pid');

            $menu = new Menus();

            $form = new Menu($menu);

            if ($pid > 0 && in_array($type, ['same', 'under'])) {
                $pid = Menus::findFirst($pid);
                if (!$pid) {
                    throw new \Exception("Menu not found");
                }

                $form->setAction($this->acl->getURL() . "/type/{$type}/pid/{$pid->menu_id}");
            } else {
                $form->addNewElements();
            }


            if ($this->request->isPost() && $form->isValid($this->request->getPost())) {
                if ($menu->addNewMenu($pid, $type)) {
                    $form = null;
                    Message::success("Menu added");
                }
            }

            $this->view->form = $form;


        } catch (\Exception $e) {
            Message::exception($e);
        }
    }

    public function editAction()
    {
        dump("DO SOMETHING HERE");
    }

    public function orderAction() {
        try {

            if(!$this->request->isPost()) {
                throw new \Exception('Invalid request method');
            }

            $order = $this->request->getPost('order');
            $order = json_decode($order, true);
            if(Menus::orderMenus($order)) {
                Message::success("Reorderd the menus");
            }




        } catch (\Exception $e) {
            Message::exception($e);
        }
    }

    public function initialize() {
        parent::initialize();
        $this->assets->addJs('assets/js/jquery.nestable.js');
    }
    public function indexAction()
    {
        try {

            $this->view->menus = Menus::getAll();


        } catch (\Exception $e) {
            Message::exception($e);
        }
    }

}

