<?php
namespace Eagle\B2b\Forms;

use Eagle\Core\Forms\Form;

REPLACE_USE_NAMESPACES;


class Services extends Form
{

    public function initialize()
    {


        $name = new Text("Name");
        $name->addFilter('trim')
            ->addFilter('striptags');
        $name->addValidator(new Between([
            'minimum' => 3]))
            ->addValidator(new Between([
                'minimum' => 200]))
            ->addValidator(new Between([
                'minimum' => 1]));
        $this->add($name);
        $type = new Select("Type");

        $type->addValidator(new Between([
            'minimum' => 1]));
        $this->add($type);
    }


}