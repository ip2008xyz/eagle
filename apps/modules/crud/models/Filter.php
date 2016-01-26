<?php
namespace Eagle\Crud\Models;


abstract class Filter extends Crud
{

    /**
     * @var string
     */
    protected $_value = '';


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
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @param string $value
     * @return Filter
     */
    public function setValue($value)
    {
        $this->_value = (string) $value;
        return $this;
    }

}