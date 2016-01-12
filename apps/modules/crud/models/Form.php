<?php
namespace Eagle\Crud\Models;


class Form
{
    /**
     * @var string
     */
    protected $_name = '';

    /**
     * @var int
     */
    protected $_id = 0;

    /**
     * @var string
     */
    protected $_table = '';

    /**
     * @var string
     */
    protected $_singular = '';


    public function __construct($data)
    {
        if (is_string($data)) {
            $data = require_once $data;
        }


        $this->populate($data);
    }

    private function populate($data = array())
    {

        foreach ($data as $k => $v) {
            $method_name = 'set' . ucfirst($k);
            if (method_exists($this, $method_name)) {
                $this->$method_name($v);
            }
        }
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param int $id
     * @return Form
     */
    public function setId($id)
    {
        $this->_id = (int)$id;
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
        $this->_name = (string)$name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSingular()
    {
        return $this->_singular;
    }

    /**
     * @param string $singular
     * @return Form
     */
    public function setSingular($singular)
    {
        $this->_singular = (string)$singular;
        return $this;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->_table;
    }

    /**
     * @param string $table
     * @return Form
     */
    public function setTable($table)
    {
        $this->_table = (string)$table;
        return $this;
    }


}