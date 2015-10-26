<?php
namespace Eagle\Core\Forms;


use Eagle\Core\Models\Modules;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Submit;

class Install extends Form
{


    /**
     * @var \Eagle\Core\Models\Modules $_module
     */
    protected $_module = null;

    public function getModule() {
        return $this->_module;
    }

    public function getModules()
    {
        return $this->_module->getAll();
    }

    public function initialize()
    {
        $this->_module = Modules::getInstance();

        $modules = $this->_module->getAll();

        foreach ($modules as $module_key => $module) {

            $element = new Check($module_key, ['value' => 1]);

            $element->setLabel($module['name']);
            if (isset($module['installed']) && $module['installed'] === true) {

                $element->setAttribute("checked", "checked");

            }

            if ($module['priority'] < 100) {
                $element->setAttribute('disabled', 'disabled');
            }

            $this->add($element);
        }

        $this->setView(CORE_PATH . '/views/forms/install.phtml');

        $submit = new Submit('Save');

        $this->add($submit);
    }


}