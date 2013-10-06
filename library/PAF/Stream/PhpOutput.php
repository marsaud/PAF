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
class PAF_Stream_PhpOutput implements PAF_Stream_Interface, PAF_Buffer_AbleInterface
{

    /**
     *
     * @var PAF_Buffer_Interface 
     */
    protected $_buffer;

    public function close()
    {
        return;
    }

    public function dropBuffer($id = NULL)
    {
        
    }

    public function flushBuffer($id = NULL)
    {
        
    }

    public function getBuffer($id = NULL)
    {
        
    }

    public function open()
    {
        return;
    }

    public function startBuffer($type = PAF_Buffer_Interface::TYPE_MEMORY)
    {
        
    }

    public function get($length = NULL, $piece = PAF_Stream_Interface::LINE)
    {
        
    }

    public function put($content)
    {
        if ($this->hasBuffer())
        {
            $this->_buffer->push($content);
        }
        else
        {
            echo $content;
        }
    }

    public function stopBuffer($id = NULL)
    {
        
    }

    public function hasBuffer()
    {
        return NULL !== $this->_buffer;
    }

}