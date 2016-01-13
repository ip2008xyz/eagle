<?php
namespace Eagle\Core\Models;

/**
 * Class Model
 * @package Eagle\Core\Models
 */
class Model {

    public function __construct($data = null)
    {
        if (is_string($data)) {
            $data = require_once $data;
        }

        if(is_array($data)) {
            $this->populate($data);
        }



    }

    protected function populate($data = array())
    {

        foreach ($data as $k => $v) {
            $method_name = 'set' . ucfirst($k);

            if (method_exists($this, $method_name)) {

                $this->$method_name($v);

            }
        }
    }

}