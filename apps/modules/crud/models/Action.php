<?php
namespace Eagle\Crud\Models;

use Eagle\Core\Models\Collection;
use Eagle\Core\Models\Model;

abstract class Action extends Model
{


    /**
     * @var string
     */
    protected $_form = '';

    /**
     * @var string
     */
    protected $_model = '';

    /**
     * @var string
     */
    protected $_name = '';

    protected $_namespaces = [];

    abstract function create();





    public function addNamespace($namespace) {
        if(isset($namespace)) {

            if(is_array($namespace)) {
                $this->_namespaces += $namespace;
            } else {
                $this->_namespaces[$namespace] = $namespace;
            }

        }
        return $this->_namespaces;
    }

    public function createContent()
    {


        return [
            'content' => [
                $this->create(),
            ],
            'namespace' => $this->addNamespace($this->_namespace),
        ];

    }

    /**
     * @return string
     */
    public function getForm()
    {
        return $this->_form;
    }

    /**
     * @param string $form
     * @return Action
     */
    public function setForm($form)
    {
        $this->_form = (string) $form;
        return $this;
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->_model;
    }

    /**
     * @param string $model
     * @return Action
     */
    public function setModel($model)
    {
        $this->_model = (string) $model;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $name
     * @return Action
     */
    public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }




}