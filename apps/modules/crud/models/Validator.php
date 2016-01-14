<?php
namespace Eagle\Crud\Models;

use Eagle\Core\Models\Model;

class Validator extends Model
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
     * @return string
     */
    public function getName()
    {
        return $this->_name;
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



}