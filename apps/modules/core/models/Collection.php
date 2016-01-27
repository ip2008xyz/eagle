<?php

namespace Eagle\Core\Models;

use Countable;
use Eagle\Crud\Models\Scanner;
use Iterator;


class Collection implements Iterator
{


    public function __construct($objectName, $items = [], $type = '')
    {

        $this->items = [];

        foreach ($items as $key => $item) {

            $tmpObjectName = $objectName;


            if (!empty($type)) {

                if (is_object($item)) {
                    $tmpObjectName = $objectName . '\\' . Scanner::createDisplayName($item->$type);
                } elseif (is_array($item)) {
                    $tmpObjectName = $objectName . '\\' . Scanner::createDisplayName($item[$type]);
                } elseif (is_numeric($key)) {
                    $tmpObjectName = $objectName . '\\' . Scanner::createDisplayName($item);
                } else {
                    $tmpObjectName = $objectName . '\\' . Scanner::createDisplayName($key);
                }

            }
            if (!class_exists($tmpObjectName)) {
                throw new \Exception("Class {$tmpObjectName} does not exist");
            }

            if ($item instanceof $tmpObjectName) {

                $this->items[] = $items;

            } elseif (is_array($item)) {

                $this->items[] = new $tmpObjectName($item);

            } else {
                $item = [$key => $item];
                $this->items[] = new $tmpObjectName($item);
            }
        }

        $this->objectName = $objectName;

        $this->position = 0;
    }


    function rewind()
    {
        $this->position = 0;
    }

    function current()
    {
        return $this->items[$this->position];
    }

    function key()
    {
        return $this->position;
    }

    function next()
    {
        ++$this->position;
    }

    function valid()
    {
        return isset($this->items[$this->position]);
    }

    public function getObjectName()
    {
        return $this->objectName;
    }

}