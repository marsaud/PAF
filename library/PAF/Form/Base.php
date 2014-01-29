<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_Form_Base
 *
 * @property-read PAF_Form_View $view Description
 * @property-read PAF_Object_DefaultNull $data Description
 * @property-read PAF_Object_DefaultNull $errors Description
 * 
 * @author fabrice
 */
class PAF_Form_Base extends PAF_Object_Base implements PAF_View_Interface
{

    const NO_ELEMENTS = NULL;
    const NO_TEMPLATE = PAF_Form_View::NO_TEMPLATE;
    const DEFAULT_VIEW = NULL;

    /**
     *
     * @var PAF_Form_View
     */
    protected $_view;

    /**
     *
     * @var ArrayObject
     */
    protected $_elements;

    /**
     *
     * @var PAF_Object_DefaultNull
     */
    protected $_data;

    /**
     *
     * @var PAF_Object_DefaultNull
     */
    protected $_errors;

    /**
     * 
     * @param array $elements
     * @param string $template
     * @param PAF_Form_View $view
     */
    public function __construct($elements = self::NO_ELEMENTS, $template = self::NO_TEMPLATE, $view = self::DEFAULT_VIEW)
    {
        parent::__construct();
        
        (self::NO_ELEMENTS !== $elements) ||
                $elements = array();

        if (!is_array($elements))
        {
            throw new PAF_Exception_IllegalArgument();
        }

        $this->_elements = new ArrayObject();
        foreach ($elements as $key => $value)
        {
            $this->addElement($key, $value);
        }
        
        if (self::DEFAULT_VIEW === $view)
        {
            $this->_initDefaultView();
        }
        else
        {
            $this->_setView($view);
        }

        (self::NO_TEMPLATE !== $template) &&
                $this->_view->template = $template;
        
        $this->_data = new PAF_Object_DefaultNull();
        $this->_errors = new PAF_Object_DefaultNull();
    }

    protected function _initProperties()
    {
        $this->_extendReadProperties(array(
            'view' => 'view',
            'data' => 'data',
            'errors' => 'errors'
        ));
    }

    protected function _setView(PAF_Form_View $view)
    {
        $this->_view = $view;
    }

    /**
     * 
     * @return PAF_Object_DefaultNull
     */
    protected function _getData()
    {
        return clone $this->_data;
    }

    /**
     * 
     * @return PAF_Object_DefaultNull
     */
    protected function _getErrors()
    {
        return clone $this->_errors;
    }

    /**
     * 
     * @return void
     */
    protected function _initDefaultView()
    {
        $this->_setView(new PAF_Form_View());
    }

    /**
     * 
     * @return void
     */
    public function render()
    {
        $this->_view->formData = $this->_data;
        $this->_view->formErrors = $this->_errors;
        $this->_view->render();
    }

    /**
     * 
     * @param string $name
     * @param PAF_Validator_Interface $validator
     * 
     * @return void
     */
    public function addElement($name, PAF_Validator_Interface $validator = NULL)
    {
        if (!is_string($name) || '' === $name)
        {
            throw new PAF_Exception_IllegalArgument();
        }
        else
        {
            $this->_elements->offsetSet($name, $validator);
        }
    }

    /**
     * 
     * @param string $name
     * 
     * @return void
     * 
     * @throws PAF_Exception_NoSuchIdentifier
     */
    public function removeElement($name)
    {
        if (!$this->_elements->offsetExists($name))
        {
            throw new PAF_Exception_NoSuchIdentifier($name);
        }
        else
        {
            $this->_elements->offsetUnset($name);
        }
    }

    /**
     * 
     * @param array $formData
     * 
     * @return boolean
     */
    public function process(array $formData)
    {
        $this->_data = new PAF_Object_DefaultNull();
        
        foreach ($formData as $key => $value)
        {
            $this->_data->$key = $value;
        }

        $formValidity = true;
        $this->_errors = new PAF_Object_DefaultNull();

        foreach ($formData as $key => $value)
        {
            if ($this->_elements->offsetExists($key) &&
                    $this->_elements->offsetGet($key) instanceof
                    PAF_Validator_Interface)
            {
                $this->_errors->$key = !$this->_elements->offsetGet($key)
                        ->validate($value);
            }
            else
            {
                $this->_errors->$key = false;
            }

            $formValidity = $formValidity && !$this->_errors->$key;
        }

        return $formValidity;
    }

    /**
     * 
     * @param string $name
     * 
     * @return mixed
     */
    public function __get($name)
    {
        try
        {
            return parent::__get($name);
        }
        catch (PAF_Exception_NoSuchProperty $exc)
        {
            unset($exc);
            return $this->_view->$name;
        }
    }

    /**
     * 
     * @param string $name
     * @param mixed $value
     * 
     * @return void
     */
    public function __set($name, $value)
    {
        try
        {
            parent::__set($name, $value);
        }
        catch (PAF_Exception_NoSuchProperty $exc)
        {
            unset($exc);
            $this->_view->$name = $value;
        }
    }

}
