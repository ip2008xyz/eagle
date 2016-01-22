<?php
namespace Eagle\B2b\Models;

use Eagle\Core\Models\MvcModel;
REPLACE_USE_NAMESPACES;

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