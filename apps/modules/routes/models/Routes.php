<?php
namespace Eagle\Routes\Models;


use Phalcon\Mvc\Model;

class Routes extends Model
{

    const ACTIVE = 1;
    const INACTIVE = 0;


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