<?php
namespace Eagle\Crud\Models;

use Eagle\Core\Models\Collection;
use Eagle\Core\Models\Model as CoreModel;

class Controller extends CoreModel
{


    protected $_template_file = '';

    public function __construct($data)
    {
        $this->_template_file = \Phalcon\DI::getDefault()->get('config')->crud->templates . '/controller.php';


        parent::__construct($data);

    }

    /**
     * @var string
     */
    protected $_namespace = '';

    /**
     * @var Action[]
     */
    protected $_actions = [];

    /**
     * Name of the controller
     * @var string
     */
    protected $_name = '';


    protected $_namespaces = [];


    protected function createInitialize()
    {

    }

    protected function createNamespaces()
    {
        if(count($this->_namespaces) > 0) {
            return 'use ' . implode(";\nuse ", $this->_namespaces) . ';';
        }
        return '';
    }

    public function createContent()
    {

        if (!is_file($this->_template_file)) {
            throw new \Exception("Template file {$this->_template_file} missing");
        }

        $template_form = file_get_contents($this->_template_file);


        return str_ireplace([
            'REPLACE_PROJECT_NAMESPACE',
            'REPLACE_CLASS_NAME',
            'const REPLACE_ACTIONS = 0;',
            'REPLACE_INITIALIZE;',
            'REPLACE_USE_NAMESPACES;',
        ],
            [
                $this->getNamespace(),
                Scanner::createFileName($this->getName()),
                $this->createActions(),
                $this->createInitialize(),
                $this->createNamespaces(),


            ],
            $template_form
        );

    }


    protected function createActions()
    {
        $content = [];

        foreach ($this->_actions as $action) {

            /**
             * @var $action Action
             */
            $field_content = $action->createContent();

            if (isset($field_content['namespace'])) {
                $this->addNamespace($field_content['namespace']);

            }


            $content[] = $field_content['content'];
        }
        return implode("\n\n", $content);


    }

    public function addNamespace($namespace)
    {
        if (isset($namespace)) {

            if (is_array($namespace)) {
                $this->_namespaces += $namespace;
            } else {
                $this->_namespaces[$namespace] = $namespace;
            }

        }
        return $this->_namespaces;
    }

    /**
     * @return Action[]
     */
    public function getActions()
    {
        return $this->_actions;
    }

    /**
     * @param Action[] $actions
     * @return Controller
     */
    public function setActions(array $actions)
    {
        $this->_actions = new Collection('Eagle\Crud\Models\Actions', $actions, 'type');

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
     * @return Controller
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
        return $this->_namespace;
    }

    /**
     * @param string $namespace
     * @return Controller
     */
    public function setNamespace($namespace)
    {
        $this->_namespace = (string) $namespace;
        return $this;
    }


}