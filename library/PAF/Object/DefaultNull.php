<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_Object_DefaultNull
 *
 * @author fabrice
 */
final class PAF_Object_DefaultNull
{
    /**
     *
     * @var ArrayObject
     */
    private $_values;
    
    public function __construct()
    {
        $this->_values = new ArrayObject();
    }
    
    public function __get($name)
    {
        if ($this->_values->offsetExists($name))
        {
            return $this->_values->offsetGet($name);
        }
        else
        {
            return NULL;
        }
    }

    public function __set($name, $value)
    {
        $this->_values->offsetSet($name, $value);
    }

    public function __isset($name)
    {
        return $this->_values->offsetExists($name);
    }

    public function __unset($name)
    {
        if ($this->_values->offsetExists($name))
        {
            $this->_values->offsetUnset($name);
        }
    }

}
