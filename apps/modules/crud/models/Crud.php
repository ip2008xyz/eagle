<?php
namespace Eagle\Crud\Models;


use Eagle\Core\Models\Model;

/**
 * Class Crud
 * Default "Model" for the CRUD module, it allows general variable and methods for all the types
 * @package Eagle\Crud\Models
 */
class Crud extends Model
{

    /**
     * @var string
     */
    protected $_templateFile = '';

    /**
     * @var string
     */
    protected $_namespace = '';

    /**
     * Name of the model
     * @var string
     */
    protected $_name = '';

    /**
     * @var string
     */
    protected $_displayName = '';

    /**
     * @var array
     */
    protected $_namespaces = [];


    public function __construct($data)
    {
        parent::__construct($data);
    }

    protected function addNamespace($namespace)
    {

        if (!empty($namespace)) {

            if (is_array($namespace)) {
                $this->_namespaces += $namespace;
            } else {
                $this->_namespaces[$namespace] = $namespace;
            }

        }

        return $this->_namespaces;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $name
     * @return Model
     */
    public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return Scanner::createFileName($this->_namespace);
    }

    /**
     * @param string $namespace
     * @return Model
     */
    public function setNamespace($namespace)
    {
        $this->_namespace = (string) $namespace;
        return $this;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        if (empty($this->_displayName)) {
            $this->setDisplayName(Scanner::createDisplayName($this->_name));
        }
        return $this->_displayName;
    }

    /**
     * @param string $displayName
     * @return Model
     */
    public function setDisplayName($displayName)
    {
        $this->_displayName = (string) $displayName;
        return $this;
    }

    /**
     * @return array
     */
    public function getNamespaces()
    {
        return $this->_namespaces;
    }

    /**
     * @param array $namespaces
     * @return Crud
     */
    public function setNamespaces(array $namespaces)
    {
        $this->_namespaces = $namespaces;
        return $this;
    }

    /**
     * @return string
     */
    public function getTemplateFile()
    {
        return $this->_templateFile;
    }

    /**
     * @param string $templateFile
     * @return Crud
     */
    public function setTemplateFile($templateFile)
    {
        $this->_templateFile = \Phalcon\DI::getDefault()->get('config')->crud->templates . "/{$templateFile}.php";
        if (!is_file($this->_templateFile)) {

            throw new \Exception("Template file does not exist {$this->_templateFile}");
        }

        return $this;
    }


}