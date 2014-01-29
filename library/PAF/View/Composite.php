<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_View_Composite
 *
 * @author fabrice
 */
class PAF_View_Composite extends PAF_View_Template
{

    const NO_COMPONENT = NULL;

    /**
     *
     * @var ArrayObject
     */
    protected $_components;

    /**
     * 
     * @param string $template
     * @param PAF_Stream_Interface $stream
     */
    public function __construct($template = self::NO_TEMPLATE, PAF_Stream_Interface $stream = NULL)
    {
        parent::__construct($template, $stream);
        $this->_components = new ArrayObject();
    }

    /**
     * 
     * @param string $componentKey
     * @param PAF_View_Interface $view
     * 
     * @eturn void
     */
    public function addComponent($componentKey, PAF_View_Interface $view)
    {
        $this->_components->offsetSet($componentKey, $view);
    }

    /**
     * 
     * @param string $componentKey
     * 
     * @return void
     * 
     * @throws PAF_Exception_NoSuchIdentifier
     */
    public function removeComponent($componentKey)
    {
        if (!$this->_components->offsetExists($componentKey))
        {
            throw new PAF_Exception_NoSuchIdentifier($componentKey);
        }
        else
        {
            $this->_components->offsetUnset($componentKey);
        }
    }

    /**
     * 
     * @param string $componentKey
     * 
     * @throws PAF_Exception_NoSuchIdentifier
     */
    public function render($componentKey = self::NO_COMPONENT)
    {
        if (self::NO_COMPONENT === $componentKey)
        {
            parent::render();
        }
        else
        {
            if (!$this->_components->offsetExists($componentKey))
            {
                throw new PAF_Exception_NoSuchIdentifier($componentKey);
            }
            else
            {
                $this->_components->offsetGet($componentKey)->render();
            }
        }
    }

}
