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
     * @var Field[]
     */
    public $_fields = null;

    /**
     * @return Field[]
     */
    public function getFields()
    {
        return $this->_fields;
    }

    public function createContent() {
        prdie($this);
    }

    /**
     * @param Field[] $fields
     * @return Form
     */
    public function setFields(array $fields)
    {
        $this->_fields = new Collection('Eagle\Crud\Models\Field', $fields);
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
     * @return Form
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
     * @return Form
     */
    public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }












}