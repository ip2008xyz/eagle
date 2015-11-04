<?php
namespace Eagle\Themes\Forms;

use Eagle\Core\Forms\Form;
use Eagle\Themes\Models\Theme;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Submit;

class Themes extends Form
{

    public function initialize()
    {

        $obj_theme = new Theme();

        $themes = $obj_theme->getAll();
        foreach ($themes as $key => $theme) {
            $default = 'inactive';

            if ($this->config->template->admin->name == $theme['name']) {
                $default = "admin";
            } elseif ($this->config->template->front->name == $theme['name']) {
                $default = "front";
            }

            $select = new Select($key);
            $select->setLabel($theme['name'])->setOptions([
                    'innactive' => 'Deactivate',
                    'front' => 'Front',
                    'admin' => 'Admin',
                ])->setDefault($default);
            $this->add($select);
        }


        $submit = new Submit('Save');

        $this->add($submit);

        $this->setView(THEMES_PATH . '/views/forms/themes.phtml');

    }
}