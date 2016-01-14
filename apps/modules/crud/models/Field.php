<?php
namespace Eagle\Crud\Models;


use Eagle\Core\Models\Model;
use Eagle\Core\Models\Collection;

class Field extends Model
{

    /**
     * @var string
     */
    protected $_type = '';

    /**
     * @var Validator[]
     */
    protected $_validators = null;

    /**
     * @var Filter[]
     */
    protected $_filters = null;


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




}