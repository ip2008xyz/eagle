<?php
namespace Eagle\Crud\Models;


use Eagle\Core\Models\Collection;
use Eagle\Core\Models\Model as CoreModel;


class Model extends CoreModel
{


    protected $_template_file = '';

    public function __construct($data)
    {
        $this->_template_file =\Phalcon\DI::getDefault()->get('config')->crud->templates . '/mvc_model.php';
        parent::__construct($data);
    }

    /**
     * @var string
     */
    protected $_source = 'db_default';

    /**
     * @var string
     */
    protected $_table = '';

    /**
     * @var string
     */
    protected $_namespace = '';

    /**
     * Name of the model
     * @var string
     */
    protected $_name = '';


    /**
     * @var string
     */
    protected $_singular = '';

    /**
     * @var array
     */
    protected $_namespaces = [];

    protected function addNamespace($namespace) {
        if(isset($namespace)) {

            if(is_array($namespace)) {
                $this->_namespaces += $namespace;
            } else {
                $this->_namespaces[$namespace] = $namespace;
            }

        }
        return $this->_namespaces;
    }

    protected function createNamespaces() {
        if(count($this->_namespaces) > 0) {
            return 'use ' . implode(";\nuse ", $this->_namespaces) . ';';
        }
        return '';

    }

    public function createContent() {

        if(!is_file($this->_template_file)) {
            throw new \Exception("Template file {$this->_template_file} missing");
        }

        $template_form = file_get_contents($this->_template_file);

        return str_ireplace([
            'REPLACE_PROJECT_NAMESPACE',
            'REPLACE_CLASS_NAME',
            'REPLACE_SOURCE',
            'REPLACE_TABLE',
            'REPLACE_USE_NAMESPACES;',
        ],
            [
                $this->getNamespace(),
                Scanner::createFileName($this->getName()),
                $this->getSource(),
                $this->getTable(),
                $this->createNamespaces(),


            ],
            $template_form
        );

        prdie($this, $template_form);

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
     * @return Model
     */
    public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return Scanner::createFileName($this->_namespace);
    }

    /**
     * @param string $namespace
     * @return Model
     */
    public function setNamespace($namespace)
    {
        $this->_namespace = (string) $namespace;
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
     * @return Model
     */
    public function setSingular($singular)
    {
        $this->_singular = (string) $singular;
        return $this;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->_source;
    }

    /**
     * @param string $source
     * @return Model
     */
    public function setSource($source)
    {
        $this->_source = (string) $source;
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
     * @return Model
     */
    public function setTable($table)
    {
        $this->_table = (string) $table;
        return $this;
    }





}