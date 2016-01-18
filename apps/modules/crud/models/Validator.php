<?php
namespace Eagle\Crud\Models;

use Eagle\Core\Models\Model;

abstract class Validator extends Model
{

    /**
     * @var string
     */
    protected $_name = '';

    /**
     * @var string
     */
    protected $_value = '';

    /**
     * @var string
     */
    protected $_namespace = '';

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }


    /**
     * create the element
     * @return mixed
     */
    abstract function create();


    public function createContent() {


        return [
            'content' => $this->create(),
            'namespace' => $this->getNamespace(),
        ];

    }

    /**
     * @param string $name
     * @return Validator
     */
    public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @param string $value
     * @return Validator
     */
    public function setValue($value)
    {
        $this->_value = (string) $value;
        return $this;
    }

    /**
     * Return the current field namespace
     * @return string
     */
    public function getNamespace() {
        return $this->_namespace;
    }



}