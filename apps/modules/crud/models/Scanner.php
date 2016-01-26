<?php
namespace Eagle\Crud\Models;


use Eagle\Core\Models\Model;
use Eagle\Core\Services\Message;

class Scanner extends Model
{

    /**
     * @var string
     */
    protected $_path = '';

    /**
     * @var string
     */
    protected $_namespace = '';

    /**
     * @var string
     */
    protected $_objectName = '';

    /**
     * @var string
     */
    protected $_extension = '.php';

    /**
     * @var array
     */
    protected $_items = [];


    /**
     * Create the name of the file to write
     * @param $name string
     * @return string
     */
    public static function createFileName($name) {
        return ucfirst($name);
    }

    public static function createDisplayName($name) {
        return ucfirst($name);
    }

    public static function createVariableName($name) {
        return trim(strtolower($name));
    }



    public static function prettyFluentMethod($content, $variable, $method) {

        $glue = ")\n->{$method}(";

        return '$' . $variable . '->' . $method . '(' . implode($glue, $content) . ');';

    }
    public static function prettyPrint($data, $limit = 0) {
        foreach($data as $k => $v) {

            if(is_array($v)) {
                $data[$k] = self::prettyPrint($v, $limit + 4);
            }

            $data[$k] = str_pad($data[$k], $limit, ' ', STR_PAD_LEFT);
        }
        return implode("\n", $data);
    }

    public static function writeToFile($file_name, $content, $replace_pattern = '')
    {

        //there is no extension to the file
        if (stripos($file_name, '.') === false) {
            if (method_exists($content, 'getName')) {
                if(empty($replace_pattern)) {
                    $file_name = $file_name . '/' . self::createFileName($content->getName()) . '.php';
                } else {
                    $file_name = $file_name . '/' . sprintf($replace_pattern, self::createFileName($content->getName()));

                }

            }
        }

        if (is_object($content)) {
            $content = $content->createContent();
        }

        if (!file_put_contents($file_name, $content)) {
            throw new \Exception("Could not wrilte file {$file_name}");
        }
        chmod($file_name, 0775);

        Message::status("Create file " . $file_name);

        return $file_name;
    }

    /**
     * Return an array of objects for all the files from a folder
     * @return array|null
     * @throws \Exception
     */
    public function load()
    {

        $this->_items = [];

        if (!is_dir($this->_path)) {
            return null;
        }

        //Scan the director
        $files = scandir($this->_path);

        //Check all the files
        foreach ($files as $k => $v) {


            if ($v === '.' || $v === '..') {
                continue;
            }

            $file = $this->_path . '/' . $v;

            //the files is the correct extension
            if (stripos($v, $this->_extension) === false) {
                continue;
            }

            $key = trim(strtolower(str_ireplace($this->_extension, '', $v)));

            //check if file exist
            if (is_file($file)) {

                $data = require_once $file;

                //check if we have an object to instantiate
                if (empty($this->_objectName)) {

                    //if we do not, we check the file if it has it's own creation object


                    //check if we have the objectname
                    if (!isset($data['objectName'])) {
                        throw new \Exception("The {$file} does not have an objectName");
                    }

                    $this->setObjectName($data['objectName']);
                    unset($data['objectName']);

                    $file = $data;
                }

                if (!isset($data['namespace'])) {
                    $data['namespace'] = $this->getNamespace();
                }

                $this->_items[$key] = new $this->_objectName($data);

            }


        }
        return $this->_items;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->_namespace;
    }

    /**
     * @param string $namespace
     * @return Scanner
     */
    public function setNamespace($namespace)
    {
        $this->_namespace = (string) $namespace;
        return $this;
    }


    /**
     * @return array
     */
    public function getItems()
    {
        return $this->_items;
    }

    /**
     * @param array $items
     * @return Scanner
     */
    public function setItems(array $items)
    {
        $this->_items = (array) $items;
        return $this;
    }


    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->_extension;
    }

    /**
     * @param string $extension
     * @return Scanner
     */
    public function setExtension($extension)
    {
        $this->_extension = (string) $extension;
        return $this;
    }


    /**
     * @return string
     */
    public function getObjectName()
    {
        return $this->_objectName;
    }

    /**
     * @param string $objectName
     * @return Scanner
     */
    public function setObjectName($objectName)
    {
        $this->_objectName = (string) $objectName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->_path;
    }

    /**
     * @param string $path
     * @return Scanner
     */
    public function setPath($path)
    {
        $this->_path = (string) $path;
        return $this;
    }

}