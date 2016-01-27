<?php
namespace Eagle\B2B\Models;

use Eagle\Core\Models\MvcModel;


class Services extends MvcModel
{

    public function initialize()
    {

        $this->setConnectionService('db_default');
        $this->setSource('services');


    }

    public function getSource()
    {
        return 'services';
    }





}