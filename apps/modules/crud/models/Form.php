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
     * @var array
     */
    protected $_namespaces = [];

    /**
     * @var string
     */
    protected $_action = null;

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


        return str_ireplace([
                'REPLACE_PROJECT_NAMESPACE',
                'REPLACE_CLASS_NAME',
                'REPLACE_ACTION;',
                'REPLACE_ELEMENTS;',
                'REPLACE_USE_NAMESPACES;',
            ],
            [
                $this->getNamespace(),
                Scanner::createFileName($this->getName()),
                $this->createAction(),
                Scanner::prettyPrint($this->createFields(), 4),
                $this->createNamespaces(),


            ],
            $template_form
        );

    }


    protected function createNamespaces() {
        return 'use ' . implode(";\nuse ", $this->_namespaces) . ';';
    }
    protected function createFields() {
        $content = [];

        foreach($this->_fields as $field) {

            /**
             * @var $field Field
             */
            $field_content = $field->createContent();

            dump($field_content['namespace']);

            if(isset($field_content['namespace'])) {

                if(is_array($field_content['namespace'])) {
                    $this->_namespaces += $field_content['namespace'];
                } else {
                    $this->_namespaces[$field_content['namespace']] = $field_content['namespace'];
                }

            }


            $content[] = $field_content['content'];
        }
        dump($this->_namespaces);
        return $content;



    }


    /**
     * Create the form action based on $_action var
     * @return string
     */
    protected function createAction() {
        if(empty($this->_action)) {
            return '';
        }
        return '$this->setAction(\'' . $this->_action . '\');';
    }



    /**
     * @param Field[] $fields
     * @return Form
     */
    public function setFields(array $fields)
    {
        //Field is abstract and create based on the type
        $this->_fields = new Collection('Eagle\Crud\Models\Fields', $fields, 'type');

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

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->_action;
    }

    /**
     * @param string $action
     * @return Form
     */
    public function setAction($action)
    {
        $this->_action = (string) $action;
        return $this;
    }















}