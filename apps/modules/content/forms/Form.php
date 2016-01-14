<?php
namespace Eagle\Content\Forms;


use Eagle\Core\Services\Debug;
use Phalcon\Annotations\Exception;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Form as PhalconForm;
use Phalcon\Filter;
use Phalcon\Validation\Message;


class Form extends PhalconForm
{
    protected $_method = 'POST';
    protected $_view = null;

    protected $_attribs = array();

    protected $_render_submit = false;

    protected $_entity_messages = array();

    public function getMethod()
    {
        return $this->_method;
    }


    public function setMethod($value)
    {
        $value = trim(strtolower($value));
        if ($value === 'get') {
            $this->_method = 'GET';
        } else {
            $this->_method = 'POST';
        }
    }

    public function getAllMessagesFor($element)
    {
        $messages = [];
        foreach ($this->getMessagesFor($element) as $message) {
            $messages[] = $message;
        }
        /* @var $model \Phalcon\Mvc\Model */
        $model = $this->getEntity();
        foreach ($model->getMessages() as $message) {
            if ($message->getField() == $element) {
                $messages[] = $message;
            }
        }
        return $messages;
    }


    public function setView($path)
    {
        if (!is_file($path)) {

            // $build_path = CORE_PATH . '/views/forms/'

            throw new \Exception("Invalid form view path");
        }
        $this->_view = $path;
    }


    public function renderForm()
    {
        $this->_attribs['action'] = $this->getAction();
        $this->_attribs['method'] = $this->getMethod();
        $attribs = array();

        foreach ($this->_attribs as $key => $value) {
            if (is_array($value)) {
                $attribs[] = "{$key}='" . implode(' ', $value) . "'";
            } else {
                $attribs[] = "{$key}='{$value}'";
            }
        }

        return '<form ' . implode(' ', $attribs) . '>';
    }


    public function renderEndForm()
    {

        $string_to_render = array();

        if($this->_render_submit === false) {
            //no submit was rendered we presume a submit button does not exist and add one
            //check if a submit element exists

            $submit = new Submit('save');
            $submit->setDefault('Save');
            $this->add($submit);
            $string_to_render[] = $this->renderDecorated('save');
            $this->_render_submit = 'save';

        }

        $string_to_render[] = '</form>';
        return implode(' ', $string_to_render);
    }

    public function renderErrors(\Phalcon\Forms\ElementInterface $element)
    {

        $messages = $this->getMessagesFor($element->getName());

        $this->getEntityMessages();

        if (isset($this->_entity_messages[$element->getName()])) {

            foreach ($this->_entity_messages[$element->getName()] as $key => $message) {
                if ($key === 'has_element') {
                    continue;
                }
                $messages->appendMessage(new Message($message->getMessage()));

            }

            $this->_entity_messages[$element->getName()]['has_element'] = true;

        } elseif ($element instanceof Submit && count($this->_entity_messages) > 0) {


            /**
             * Attach all the errors to submit, must be sure Submit is always last
             */

            foreach ($this->_entity_messages as $k => $model_messages) {
                if (isset($model_messages['has_element']) && $model_messages['has_element'] === true) {
                    continue;
                }
                foreach ($model_messages as $message) {
                    $messages->appendMessage(new Message($message->getMessage()));
                }

            }

        }

        $element_string = array();

        // Get any generated messages for the current element
        if ($messages->count()) {

            // Print each element
            $element_string[] = '<div class="alert alert-danger"><ul>';

            foreach ($messages as $message) {
                $element_string[] = '<li>' . $message->getMessage() . '</li>';
            }
            $element_string[] = '</ul></div>';
        }

        return implode(' ', $element_string);
    }

    public function __toString()
    {
        if ($this->request->isAjax()) {
            $this->_attribs['class'][] = 'ajaxSubmit';
        }

        try {
            if (!is_null($this->_view) && is_file($this->_view)) {
                include $this->_view;
                return '';
            }

            $string_to_return = array();

            $string_to_return[] = $this->renderForm();

            foreach ($this->getElements() as $element_key => $element) {
                if($element instanceof Submit) {
                    $this->_render_submit = $element_key;
                }
                $string_to_return[] = $this->renderDecorated($element_key);

            }

            $string_to_return[] = $this->renderEndForm();
            return implode(' ', $string_to_return);
        } catch (\Exception $e) {
            Debug::exception($e, true);

        }
        return '';

    }

    public function getEntityMessages()
    {

        if (empty($this->_entity_messages)) {

            if ($this->getEntity() && $this->getEntity()->getMessages()) {

                foreach ($this->getEntity()->getMessages() as $message) {

                    $this->_entity_messages[$message->getField()][] = new Message($message->getMessage());

                }
            }

        }

        return $this->_entity_messages;
    }

    public function renderDecorated($name)
    {

        $element_string = array();

        $element = $this->get($name);

        $element_string[] = '<div>';

        if (!($element instanceof Hidden)) {
            $element_string[] = '<label for="' . $element->getName() . '">' . $element->getLabel() . '</label>';
        }

        $element_string[] = $element->render();

        $element_string[] = $this->renderErrors($element);


        $element_string[] = '</div>';

        return implode(' ', $element_string);


    }

    public function getValues()
    {

        $filter = new Filter();

        $elements = array();

        foreach ($this->getElements() as $element_name => $element) {
            $element_value = $element->getValue();

            if ($element->getFilters()) {
                foreach ($element->getFilters() as $filter_name) {
                    $element_value = $filter->sanitize($element_value, $filter_name);
                }
            }
            $elements[$element_name] = $element_value;
        }
        return $elements;
    }


}