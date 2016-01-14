<?php
namespace Eagle\Crud\Models;


use Eagle\Core\Models\Model;

class Crud extends Model
{

    protected $_forms = [];

    public function getAll($project, $path, $type = 'form')
    {
        $path = $path . '/'. $project . "/{$type}";
        $files = scandir($path);

        foreach ($files as $k => $v) {
            if ($v === '.' || $v === '..') {
                continue;
            }

            $file = $path . '/' . $v;

            if (is_file($file)) {

                $form = new Form($file);

                $this->_forms[$form->name] = $form;
            }


        }

        return $this->_forms;
    }
}