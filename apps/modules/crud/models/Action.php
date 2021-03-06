<?php
namespace Eagle\Crud\Models;


abstract class Action extends Crud
{


    /**
     * @var string
     */
    protected $_form = '';

    /**
     * @var string
     */
    protected $_model = '';

    /**
     * @var string
     */
    protected $_view = '';

    abstract function create();


    public function createContent()
    {


        return [
            'content' => $this->create(),
            'namespace' => $this->addNamespace($this->_namespace),
        ];

    }

    /**
     * @return string
     */
    public function getForm()
    {
        return $this->_form;
    }

    /**
     * @param string $form
     * @return Action
     */
    public function setForm($form)
    {
        $this->_form = (string) $form;
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
     * @return Action
     */
    public function setModel($model)
    {
        $this->_model = (string) $model;
        return $this;
    }


    /**
     * @return string
     */
    public function getView()
    {
        return $this->_view;
    }

    /**
     * @param string $view
     * @return Controller
     */
    public function setView($view)
    {
        $this->_view = (string) $view;
        return $this;
    }


}