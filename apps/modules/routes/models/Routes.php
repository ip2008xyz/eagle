<?php
namespace Eagle\Routes\Models;


use Eagle\Core\Models\MvcModel;

class Routes extends MvcModel
{


    public function initialize()
    {

        $this->setConnectionService('db_default');
        $this->setSource("routes");

    }

    public static function getAll()
    {
        return self::find();
    }



}