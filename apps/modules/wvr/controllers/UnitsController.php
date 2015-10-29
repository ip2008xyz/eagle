<?php

namespace Eagle\Wvr\Controllers;

use Eagle\Menus\Forms\Menu;
use Eagle\Core\Services\Message;
use Eagle\Menus\Models\Menus;
use Phalcon\Annotations\Exception;


class UnitsController extends ControllerBase
{

    public function indexAction()
    {
        try {
            dump(__LINE__);




        } catch (\Exception $e) {
            Message::exception($e);
        }
    }



}

