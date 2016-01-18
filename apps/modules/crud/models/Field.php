<?php
namespace Eagle\Crud\Models;

use Eagle\Core\Models\Model;
use Eagle\Core\Models\Collection;

abstract class Field extends Model
{

    /**
     * @var string
     */
    protected $_type = '';

    /**
     * @var string
     */
    protected $_namespace = '';

    /**
     * @var string
     */
    protected $_name = '';


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



    protected function addElement() {
        return '$this->add($' . $this->getFieldName() . ');';
    }

    public function createFilters() {

        $namespaces = [];
        $content = [];

        foreach($this->_filters as $filter) {
            /**
             * @var $field Filter
             */
            $field_content = $filter->createContent();

            $namespaces[$field_content['namespace']] = $field_content['namespace'];
            $content[] = $field_content['content'];
        }

        foreach($this->_filters as $filter) {

        }
        prdie($this);
    }
    public function createContent() {

        return [
            'content' => implode("\n", [
                $this->create(),
                $this->createFilters(),
                $this->createValidators(),
                $this->addElement(),
                ]),
            'namespace' => $this->getNamespace(),
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

        $this->_filters = new Collection('Eagle\Crud\Models\Filter', $filters);

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
        $this->_type = (string) $type;
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
        $this->_validators = new Collection('Eagle\Crud\Models\Validator', $validators);;
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
     * @return Field
     */
    public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }


    /**
     * Return the var name of the field
     * @return string
     */
    public function getFieldName() {
        return trim(strtolower($this->_name));
    }

    /**
     * Return the current field namespace
     * @return string
     */
    public function getNamespace() {
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
        $this->_label = (string) $label;
        return $this;
    }







}