<?php
namespace Eagle\Crud\Models;


use Eagle\Core\Models\Collection;
use Eagle\Core\Models\Model;


class Form extends Model
{


    protected $_template_file = '';

    public function __construct($data)
    {
        $this->_template_file =\Phalcon\DI::getDefault()->get('config')->crud->templates . '/form.php';
        parent::__construct($data);
    }

    /**
     * @var string
     */
    protected $_namespace = '';

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

        if(!is_file($this->_template_file)) {
            throw new \Exception("Template file {$this->_template_file} missing");
        }

        $template_form = file_get_contents($this->_template_file);

        return str_ireplace(
            [
                'REPLACE_PROJECT_NAMESPACE',

            ]
        ,  [
                $this->getNamespace(),
            ],
            $template_form);

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

    /**
     * @return string
     */
    public function getNamespace()
    {
        return ucfirst($this->_namespace);
    }

    /**
     * @param string $namespace
     * @return Form
     */
    public function setNamespace($namespace)
    {
        $this->_namespace = (string) $namespace;
        return $this;
    }












}