<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_View_Abstract
 * 
 * USEFULL ?
 *
 * @author fabrice
 */
abstract class PAF_View_Abstract implements PAF_View_Interface
{
    /**
     *
     * @var PAF_Stream_Interface
     */
    protected $_stream;
    
    /**
     *
     * @var string
     */
    protected $_content;
    
    abstract public function render();
}