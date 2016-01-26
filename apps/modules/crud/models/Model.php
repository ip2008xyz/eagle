<?php
namespace Eagle\Crud\Models;


class Model extends Crud
{


    public function __construct($data)
    {
        $data['templateFile'] = 'model';
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
    protected $_singular = '';



    protected function createNamespaces() {
        if(count($this->_namespaces) > 0) {
            return 'use ' . implode(";\nuse ", $this->_namespaces) . ';';
        }
        return '';

    }

    public function createContent() {

        $template_form = file_get_contents($this->_templateFile);

        return str_ireplace([
            'REPLACE_PROJECT_NAMESPACE',
            'REPLACE_CLASS_NAME',
            'REPLACE_SOURCE',
            'REPLACE_TABLE',
            'REPLACE_USE_NAMESPACES;',
        ],
            [
                $this->getNamespace(),
                $this->getDisplayName(),
                $this->getSource(),
                $this->getTable(),
                $this->createNamespaces(),


            ],
            $template_form
        );

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