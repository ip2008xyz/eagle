<?php
namespace Eagle\Crud\Models;


use Eagle\Core\Models\Model;

class Field extends Model
{

    /**
     * @var string
     */
    protected $_type = '';


    /**
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }


    /**
     * @param string $type
     * @return Field
     */
    public function setType($type)
    {
        $this->_type = (string) $type;
        return $this;
    }



}