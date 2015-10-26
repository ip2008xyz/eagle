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


class Login extends Form
{
    public function initialize()
    {


        $user_name = new Text("user_name");
        $user_name->setLabel('User name')
            //->setDefault('username')
            ->addFilter('trim')
            ->addFilter('striptags')
            ->addValidators(array(
            new StringLength(array(
                'max' => 50,
                'min' => 3,
                'messageMaximum' => 'We don\'t like really long names',
                'messageMinimum' => 'We want more than just their initials'
            )),
            new Regex(array(
                'pattern' => '/^[a-zA-Z0-9\_\-]+$/',
                'message' => 'Allow only letters, digits, - and _',
            ))
                )
        );

        $user_password = new Password("user_password");
        $user_password->setLabel('Password')
            ->setDefault('password')
            ->addFilter('trim')
            ->addFilter('striptags')
            ->addValidator(
            new StringLength(array(
                'max' => 50,
                'min' => 6,
                'messageMaximum' => 'You will forget a really long password',
                'messageMinimum' => 'We like more complicated password'
            )));

        $user_password->addFilter('trim');

        $submit = new Submit('save');
        $submit->setDefault('Save');


        // CSRF
        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array(
            'value' => $this->security->getSessionToken(),
            'message' => 'CSRF validation failed'
        )))
            ->setDefault($this->security->getToken());


        /*$filter = new Filter();

        // Using an anonymous function
        $filter->add('trim', function ($value) {
                    return preg_replace('/[^0-9a-f]/', '', $value);
                });

        // Sanitize with the "md5" filter
        $filtered = $filter->sanitize($possibleMd5, "md5");*/

        $this->add($user_name);
        $this->add($user_password);
        //$this->add($csrf);

        $this->add($submit);

    }





}