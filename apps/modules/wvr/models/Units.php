<?php
namespace Eagle\Wvr\Models;

use Phalcon\Mvc\Model;

class Units extends Model
{

    public function initialize()
    {

        $this->setConnectionService('db_default');
        $this->setSource("units");

        //$this->hasMany('menu_id', 'Eagle\Menus\Models\Menus', 'menu_pid', array('alias' => 'leafs'));
        //$this->belongsTo('menu_pid', 'Eagle\Menus\Models\Menus', 'menu_id', array('alias' => 'parent'));
    }



}