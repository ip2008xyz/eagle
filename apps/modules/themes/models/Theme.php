<?php

namespace Eagle\Themes\Models;

class Theme
{

    protected $_theme_path = VIEWS_PATH;

    public function getAll()
    {
        $files = scandir($this->_theme_path);

        foreach ($files as $k => $v) {
            if ($v === '.' || $v === '..') {
                continue;
            }
            $file = $this->_theme_path . '/' . $v . '/info.php';

            if (is_file($file)) {
                $themes[$v] = require_once $file;
            }

        }
        return $themes;
    }
}