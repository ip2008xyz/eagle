<?php
namespace Eagle\Auth\Forms;

use Eagle\Core\Forms\Form;
use Phalcon\Filter;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\StringLength;


class Role extends Form
{
    public function initialize()
    {
        $this->setAction($this->acl->getURL());

        $role_id = new Hidden("role_id");

        $role_name = new Text("role_name");
        $role_name->setLabel('Role name')
            ->addFilter('trim')
            ->addFilter('striptags');

        $submit = new Submit('Save');

        $this->add($role_id);
        $this->add($role_name);


        $this->add($submit);

    }





}