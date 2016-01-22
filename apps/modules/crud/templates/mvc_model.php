<?php
namespace Eagle\REPLACE_PROJECT_NAMESPACE\Models;

use Eagle\Core\Models\MvcModel;
REPLACE_USE_NAMESPACES;

class REPLACE_CLASS_NAME extends MvcModel
{

    public function initialize()
    {

        $this->setConnectionService('REPLACE_SOURCE');
        $this->setSource('REPLACE_TABLE');


    }

    public function getSource()
    {
        return 'REPLACE_TABLE';
    }





}