<?php
namespace Eagle\Crud\Models;


use Eagle\Core\Models\Collection;


class Form extends Crud
{


    public function __construct($data)
    {
        $data['templateFile'] = 'form';
        parent::__construct($data);

    }

    protected $_subNamespace = 'Forms';

    /**
     * @var string
     */
    protected $_action = null;

    /**
     * Main model attached to the form
     * @var string
     */
    protected $_model = '';

    /**
     * @var Field[]
     */
    public $_fields = null;


    public function writeToFile($exportPath) {
        Scanner::writeToFile($exportPath . '/forms', $this);
    }



    public function createContent()
    {

        $template_form = file_get_contents($this->getTemplateFile());


        return str_ireplace([
            'REPLACE_PROJECT_NAMESPACE',
            'REPLACE_CLASS_NAME',
            'REPLACE_ACTION;',
            'REPLACE_ELEMENTS;',
            'REPLACE_USE_NAMESPACES;',
        ],
            [
                $this->getNamespace(),
                $this->getDisplayName(),
                $this->createAction(),
                Scanner::prettyPrint($this->createFields(), 4),
                $this->createNamespaces(),


            ],
            $template_form
        );

    }

    protected function createNamespaces()
    {

        if (count($this->_namespaces) > 0) {
            return 'use ' . implode(";\nuse ", $this->_namespaces) . ';';
        }
        return '';
    }

    protected function createFields()
    {
        $content = [];

        foreach ($this->_fields as $field) {

            /**
             * @var $field Field
             */
            $field_content = $field->createContent();

            $this->addNamespace($field_content['namespace']);
            $content[] = $field_content['content'];
        }

        return $content;


    }


    /**
     * Create the form action based on $_action var
     * @return string
     */
    protected function createAction()
    {
        if (empty($this->_action)) {
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

    /**
     * @return Field[]
     */
    public function getFields()
    {
        return $this->_fields;
    }



}