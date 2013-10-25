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

    /**
     * @codeCoverageIgnore
     */
    abstract protected function _init();

    /**
     * @codeCoverageIgnore
     */
    abstract public function flush();

    /**
     * @codeCoverageIgnore
     */
    abstract public function get();

    public function getId()
    {
        return $this->id;
    }

    /**
     * @codeCoverageIgnore
     */
    abstract public function pull($length = NULL, $piece = PAF_Buffer_Interface::LINE);

    /**
     * @codeCoverageIgnore
     */
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