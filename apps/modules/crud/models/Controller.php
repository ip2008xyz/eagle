<?php
namespace Eagle\Crud\Models;

use Eagle\Core\Models\Collection;


class Controller extends Crud
{


    public function __construct($data)
    {
        $data['templateFile'] = 'controller';
        parent::__construct($data);

    }



    protected $_subNamespace = 'Controllers';

    /**
     * @var Action[]
     */
    protected $_actions = [];

    /**
     * @var View[]
     */
    protected $_views = [];

    protected function createInitialize()
    {

    }

    public function writeToFile($exportPath) {
        Scanner::writeToFile($exportPath . '/controllers', $this, '%sController.php');
        prdie($this->_actions);
    }

    protected function createNamespaces()
    {
        if (count($this->_namespaces) > 0) {
            return 'use ' . implode(";\nuse ", $this->_namespaces) . ';';
        }
        return '';
    }

    public function createContent()
    {

        $template_form = file_get_contents($this->getTemplateFile());

        return str_ireplace([
            'REPLACE_PROJECT_NAMESPACE',
            'REPLACE_CLASS_NAME',
            'const REPLACE_ACTIONS = 0;',
            'REPLACE_INITIALIZE;',
            'REPLACE_USE_NAMESPACES;',
        ],
            [
                $this->getNamespace(),
                $this->getDisplayName(),
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
     * @return View[]
     */
    public function getViews()
    {
        return $this->_views;
    }

    /**
     * @param View[] $views
     * @return Controller
     */
    public function setViews(array $views)
    {

        $this->_views = new Collection('Eagle\Crud\Models\Views', $views, 'type');
        return $this;
    }





}