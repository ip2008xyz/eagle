<?php

namespace Eagle\Core\Models;

use Countable;
use Iterator;


class Collection
{


    public function __construct($objectName, $items = [])
    {

        $this->items = [];

        foreach($items as $key => $item) {

            if($item instanceof  $objectName) {

                $this->items[] = $items;

            } elseif(is_array($item)) {

                $this->items[] = new $objectName($item);

            } else {
                $item = [$key => $item];
                $this->items[] = new $objectName($item);
            }
        }

        $this->objectName = $objectName;

        $this->position = 0;
    }


    function rewind() {
        $this->position = 0;
    }

    function current() {
        return $this->items[$this->position];
    }

    function key() {
        return $this->position;
    }

    function next() {
        ++$this->position;
    }

    function valid() {
        return isset($this->items[$this->position]);
    }

    public function getObjectName()
    {
        return $this->objectName;
    }

}