<?php

namespace Eagle\Themes\Models;

use Eagle\Core\Models\Config;
use Eagle\Core\Models\Model;

class Theme extends Model
{

    protected $_theme_path = VIEWS_PATH;

    protected $_themes = null;

    public function getAll()
    {
        if(is_null($this->_themes)) {
            $this->_themes = array();

            $files = scandir($this->_theme_path);

            foreach ($files as $k => $v) {
                if ($v === '.' || $v === '..') {
                    continue;
                }
                $file = $this->_theme_path . '/' . $v . '/info.php';

                if (is_file($file)) {
                    $this->_themes[$v] = require_once $file;
                }

            }

        }
        return $this->_themes;

    }

    public function storeThemes($input) {

        foreach($input as $theme_name => $theme_status) {
           if(!isset($this->_themes[$theme_name])) {
               continue;
           }

           if($theme_status === 'admin') {
                Config::writeDefine('ADMIN_THEME', $theme_name);
           } elseif($theme_status === 'front') {
               Config::writeDefine('FRONT_THEME', $theme_name);
           }

        }


    }
}