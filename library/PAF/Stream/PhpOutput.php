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
final class PAF_Stream_PhpOutput implements PAF_Stream_Interface, PAF_Buffer_AbleInterface
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

    public function dropBuffer()
    {
        if (!$this->hasBuffer())
        {
            throw new PAF_Exception_NoSuchResource();
        }
        else
        {
            $this->_buffer = PAF_Buffer_Manager::drop($this->_buffer);
        }
    }

    public function flushBuffer()
    {
        if (!$this->hasBuffer())
        {
            throw new PAF_Exception_NoSuchResource();
        }
        else
        {
            $this->_putDirect($this->_buffer->flush());
        }
    }

    public function getBuffer()
    {
        if (!$this->hasBuffer())
        {
            throw new PAF_Exception_NoSuchResource();
        }
        else
        {
            return $this->_buffer->get();
        }
    }

    public function open()
    {
        return;
    }

    public function startBuffer($type = PAF_Buffer_Interface::TYPE_MEMORY)
    {
        if (!$this->hasBuffer())
        {
            $this->_buffer = PAF_Buffer_Manager::factory($type);
        }
        else
        {
            PAF_Buffer_Manager::start($this->_buffer, $type);
        }
    }

    public function get($length = NULL, $piece = PAF_Stream_Interface::LINE)
    {
        throw new PAF_Exception_NoImplementation();
    }

    public function put($content)
    {
        if ($this->hasBuffer())
        {
            $this->_buffer->push($content);
        }
        else
        {
            $this->_putDirect($content);
        }
    }

    protected function _putDirect($content)
    {
        echo $content;
    }

    public function stopBuffer()
    {
        if (!$this->hasBuffer())
        {
            throw new PAF_Exception_NoSuchResource ();
        }
        else
        {
            $content = NULL;
            $this->_buffer = PAF_Buffer_Manager::stop($this->_buffer, $content);
            return $content;
        }
    }

    public function hasBuffer()
    {
        return NULL !== $this->_buffer;
    }

}