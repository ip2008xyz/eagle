<?php
namespace Eagle\Crud\Models;


abstract class View extends Crud
{


    /**
     * @var string
     */
    protected $_view = '';

    abstract function create();


    public function createContent()
    {


        return [
            'content' => $this->create(),
            'namespace' => $this->addNamespace($this->_namespace),
        ];

    }

}