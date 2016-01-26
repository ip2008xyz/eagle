<?php
namespace Eagle\Crud\Models;


use Eagle\Core\Models\Collection;

abstract class Field extends Crud
{

    /**
     * @var string
     */
    protected $_type = '';

    /**
     * @var array
     */
    protected $_options = [];

    /**
     * @var string
     */
    protected $_label = '';

    /**
     * @var Validator[]
     */
    protected $_validators = null;

    /**
     * @var Filter[]
     */
    protected $_filters = null;

    /**
     * create the element
     * @return mixed
     */
    abstract function create();


    protected function addElement()
    {
        return '$this->add($' . $this->getFieldName() . ');';
    }

    public function createFilters()
    {

        $content = [];
        if (empty($this->_filters)) {
            return '';
        }

        foreach ($this->_filters as $filter) {
            /**
             * @var $field Filter
             */
            $field_content = $filter->createContent();


            $this->addNamespace($field_content['namespace']);

            $content[] = $field_content['content'];
        }

        return Scanner::prettyFluentMethod($content, $this->getFieldName(), 'addFilter');

    }

    public function createValidators()
    {

        $content = [];
        if (empty($this->_validators)) {
            return '';
        }

        foreach ($this->_validators as $validator) {
            /**
             * @var $field Validator
             */
            $field_content = $validator->createContent();


            $this->addNamespace($field_content['namespace']);

            $content[] = $field_content['content'];
        }

        return Scanner::prettyFluentMethod($content, $this->getFieldName(), 'addValidator');


    }


    public function createContent()
    {


        return [
            'content' => [
                $this->create(),
                $this->createFilters(),
                $this->createValidators(),
                $this->addElement(),
            ],
            'namespace' => $this->addNamespace($this->_namespace),
        ];

    }


    /**
     * @return Filter[]
     */
    public function getFilters()
    {
        return $this->_filters;
    }

    /**
     * @param Filter[] $filters
     * @return Field
     */
    public function setFilters(array $filters)
    {


        $this->_filters = new Collection('Eagle\Crud\Models\Filters', $filters, 'name');

        return $this;
    }

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
        $this->_type = (string)$type;
        return $this;
    }

    /**
     * @return Validator[]
     */
    public function getValidators()
    {
        return $this->_validators;
    }

    /**
     * @param Validator[] $validators
     * @return Field
     */
    public function setValidators(array $validators)
    {
        $this->_validators = new Collection('Eagle\Crud\Models\Validators', $validators, 'name');
        return $this;
    }

    /**
     * Return the var name of the field
     * @return string
     */
    public function getFieldName()
    {
        return trim(strtolower($this->_name));
    }

    /**
     * Return the current field namespace
     * @return string
     */
    public function getNamespace()
    {
        return $this->_namespace;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->_label;
    }

    /**
     * @param string $label
     * @return Field
     */
    public function setLabel($label)
    {
        $this->_label = (string)$label;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * @param array $options
     * @return Field
     */
    public function setOptions($options)
    {
        $this->_options = $options;
        return $this;
    }


}