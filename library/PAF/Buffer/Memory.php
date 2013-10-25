<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_Buffer_Memory
 *
 * @author fabrice
 */
class PAF_Buffer_Memory extends PAF_Buffer_Abstract implements PAF_Buffer_AbleInterface
{

    /**
     *
     * @var PAF_Buffer_Memory
     */
    protected $_buffer;

    /**
     *
     * @var PAF_Buffer_Interface
     */
    protected $_b;

    /**
     *
     * @var string
     */
    protected $_content;

    /**
     * @return void
     */
    protected function _init()
    {
        $this->_b = PAF_Buffer_Manager::factory(PAF_Buffer_Interface::TYPE_MEMORYSIMPLE);
    }

    /**
     * 
     * @param string $content
     * 
     * @return void
     */
    public function push($content)
    {
        if ($this->hasBuffer())
        {
            $this->_pushToBuffer($content);
        }
        else
        {
            $this->_pushDirect($content);
        }
    }
    
    protected function _pushToBuffer($content)
    {
        $this->_buffer->push($content);
    }

    /**
     * 
     * @param string $content
     * 
     * @return void
     */
    protected function _pushDirect($content)
    {
        $this->_b->push($content);
    }

    /**
     * 
     * @return PAF_Buffer_Memory
     * 
     * @throws PAF_Exception_NoSuchResource
     */
    public function dropBuffer()
    {
        if (!$this->hasBuffer())
        {
            throw new PAF_Exception_NoSuchResource();
        }
        elseif ($this->_buffer->hasBuffer())
        {
            $this->_buffer->dropBuffer();
            return $this;
        }
        else
        {
            $this->_buffer = NULL;
            return $this;
        }
    }

    /**
     * 
     * @return void
     * 
     * @throws PAF_Exception_NoSuchIdentifier
     */
    public function flushBuffer()
    {
        if (!$this->hasBuffer())
        {
            throw new PAF_Exception_NoSuchResource();
        }
        elseif ($this->_buffer->hasBuffer())
        {
            $this->_buffer->flushBuffer();
        }
        else
        {
            $this->_pushDirect($this->_buffer->flush());
        }
    }

    /**
     * 
     * @param string $id
     * 
     * @return string|NULL
     * 
     * @throws PAF_Exception_NoSuchIdentifier
     */
    public function getBuffer()
    {
        if (!$this->hasBuffer())
        {
            throw new PAF_Exception_NoSuchResource();
        }
        elseif ($this->_buffer->hasBuffer())
        {
            return $this->_buffer->getBuffer();
        }
        else
        {
            return $this->_buffer->get();
        }
    }

    /**
     * 
     * @param string $length
     * @param string $piece
     * 
     * @return string
     * 
     * @throws PAF_Exception_IllegalArgument
     */
    public function pull($length = NULL, $piece = PAF_Buffer_Interface::LINE)
    {
        if ($this->hasBuffer())
        {
            return $this->_buffer->pull($length, $piece);
        }
        else
        {
            return $this->_b->pull($length, $piece);
        }
    }

    /**
     * 
     * @return string
     */
    public function get()
    {
        return $this->_b->get();
    }

    /**
     * 
     * @return void
     */
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

    /**
     * 
     * @param string $id
     * 
     * @return string
     * 
     * @throws PAF_Exception_NoSuchIdentifier
     */
    public function stopBuffer()
    {
        if (!$this->hasBuffer())
        {
            throw new PAF_Exception_NoSuchResource();
        }
        elseif ($this->_buffer->hasBuffer())
        {
            return $this->_buffer->stopBuffer();
        }
        else
        {
            $output = $this->_buffer->get();
            $this->_buffer = NULL;
            return $output;
        }
    }

    /**
     * 
     * @return string
     */
    public function flush()
    {
        return $this->_b->flush();
    }
    
    /**
     * 
     * @return boolean
     */
    public function hasBuffer()
    {
        return (NULL !== $this->_buffer);
    }


}