<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_View_Template
 * 
 * @property string $template A path to a php template file
 *
 * @author fabrice
 */
class PAF_View_Template extends PAF_View_Abstract
{

    const NO_TEMPLATE = null;

    /**
     *
     * @var string
     */
    protected $_template = NULL;

    /**
     *
     * @var ArrayObject
     */
    protected $_data;

    /**
     * 
     * @param string $template
     * @param PAF_Stream_Interface $stream
     */
    public function __construct($template = self::NO_TEMPLATE, $stream = self::DEFAULT_STREAM)
    {
        parent::__construct($stream);

        $this->_data = new ArrayObject();
        if (self::NO_TEMPLATE !== $template)
        {
            $this->_setTemplate($template);
        }
    }

    /**
     * 
     * @return void
     */
    protected function _initProperties()
    {
        parent::_initProperties();
        
        $this->_extendProperties(array(
            'template' => 'template'
        ));
    }

    /**
     * 
     * @param string $template
     * 
     * @throws PAF_Exception_NoSuchResource
     */
    protected function _setTemplate($template)
    {
        if (is_file($template))
        {
            $this->_template = $template;
        }
        else
        {
            throw new PAF_Exception_NoSuchResource('file not found : ' . $template);
        }
    }

    /**
     * 
     * @return void
     */
    protected function _initDefaultStream()
    {
        $this->_setStream(new PAF_Stream_PhpOutput());
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
            return $this->_data->offsetGet($name);
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
            $this->_data->offsetSet($name, $value);
        }
    }

    /**
     * 
     * @return void
     * 
     * @throws PAF_Exception_MissingResource
     */
    public function render()
    {
        if (self::NO_TEMPLATE !== $this->_template)
        {
            ob_start();
            include $this->_template;
            $this->_stream->put(ob_get_clean());
        }
        else
        {
            throw new PAF_Exception_MissingResource('No template available');
        }
    }
    
    /**
     * 
     * @return string
     */
    public function __toString()
    {   
        return json_encode($this->_template) . json_encode($this->_data);
    }

}
