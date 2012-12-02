<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_Stream_PhpOutput
 *
 * @author fabrice
 */
class PAF_Stream_PhpOutput implements PAF_Stream_Interface
{
    /**
     * @todo IMBRICATED BUFFER MANAGER
     *
     * @var type 
     */
    protected $_buffer;
    
    public function close()
    {
        return;
    }

    public function dropBuffer($id)
    {
        
    }

    public function flushBuffer($id = NULL)
    {
        
    }

    public function getBuffer($id)
    {
        
    }

    public function open()
    {
        return;
    }

    public function pull()
    {
        
    }

    public function push($content)
    {
        /**
         * @todo Handle Buffers
         */
        echo $content;
    }

    public function startBuffer()
    {
        
    }
}