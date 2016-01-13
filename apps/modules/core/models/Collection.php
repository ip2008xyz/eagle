<?php

namespace Eagle\Core\Models;

use Countable;
use Iterator;


class Collection implements Iterator
{

    protected $items;
    private $objectName;
    private $position = 0;

    public function __construct($objectName, $items = [])
    {
        $this->items = [];
        foreach($items as $item) {
            if($item instanceof  $objectName) {
                $this->items[] = $items;
            } else {
                $this->items[] = new $objectName($this->objectName);
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