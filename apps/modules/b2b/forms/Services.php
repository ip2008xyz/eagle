<?php
namespace Eagle\B2b\Forms;

use Eagle\Core\Forms\Form;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Submit;


class Services extends Form {

    public function initialize()
    {
        


        $name = new Text("Name");
$name->addFilter('trim')
->addFilter('striptags');
$name->addValidator(new Between([
   'minimum' => 3
]))
->addValidator(new Between([
   'max' => 200
]))
->addValidator(new PresenceOf());
$this->add($name);
$type = new Select("Type");
        
$type->addValidator(new PresenceOf());
$this->add($type);
$save = new Submit("Save");
        
        
$this->add($save);
    }


}