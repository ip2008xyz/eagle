<?php
namespace Eagle\Crud\Models;


use Eagle\Core\Models\Collection;
use Eagle\Core\Models\Model;

class Form extends Model
{

    /**
     * Name of the form
     * @var string
     */
    protected $_name = '';

    /**
     * Main model attached to the form
     * @var string
     */
    protected $_model = '';

    /**
     * @var Collection of Field
     */
    public $_fields = null;


    /**
     * @return Field[]
     */
    public function getFields3()
    {
        return $this->_fields;
    }

    /**
     * @param $fields Collection
     * @return Form
     */
    public function setFields(Collection $fields)
    {

        $this->_fields = $fields;

        return $this;
    }


}