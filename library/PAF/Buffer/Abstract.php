<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_Buffer_Abstract
 *
 * @property-read string $id Description
 * 
 * @author fabrice
 */
abstract class PAF_Buffer_Abstract implements PAF_Buffer_Interface
{

    /**
     *
     * @var string
     */
    protected $_id;

    final public function __construct()
    {
        $this->_id = uniqid();
        $this->_init();
    }

    protected function _init()
    {
        
    }

    abstract public function flush();

    abstract public function get();

    public function getId()
    {
        return $this->id;
    }

    abstract public function pull($length = NULL, $piece = PAF_Buffer_Interface::LINE);

    abstract public function push($content);

    public function __get($name)
    {
        if ('id' != $name)
        {
            throw new PAF_Exception_NoSuchProperty();
        }
        else
        {
            return $this->_id;
        }
    }

}