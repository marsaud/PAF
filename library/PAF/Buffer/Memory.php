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
        if (isset($this->_buffer))
        {
            $this->_buffer->push($content);
        }
        else
        {
            $this->_pushDirect($content);
        }
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
     * @param string $id
     * 
     * @return void
     * 
     * @throws PAF_Exception_NoSuchIdentifier
     */
    public function dropBuffer($id = NULL)
    {
        if (!isset($this->_buffer))
        {
            throw new PAF_Exception_NoSuchIdentifier('No ' . $id . ' in buffer stack.');
        }
        elseif (NULL === $id || $id == $this->_buffer->id)
        {
            $this->_buffer = NULL;
        }
        else
        {
            $this->_buffer->dropBuffer($id);
        }
    }

    /**
     * 
     * @param string $id
     * 
     * @return void
     * 
     * @throws PAF_Exception_NoSuchIdentifier
     */
    public function flushBuffer($id = NULL)
    {
        if (!isset($this->_buffer))
        {
            throw new PAF_Exception_NoSuchIdentifier('No ' . $id . ' in buffer stack.');
        }
        elseif (NULL === $id || $id == $this->_buffer->id)
        {
            $this->_pushDirect($this->_buffer->flush());
        }
        else
        {
            $this->_buffer->flushBuffer($id);
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
    public function getBuffer($id = NULL)
    {
        if (!isset($this->_buffer))
        {
            throw new PAF_Exception_NoSuchResource('No ' . $id . ' in buffer stack.');
        }
        elseif (NULL === $id || $id == $this->_buffer->id)
        {
            return $this->_buffer->get();
        }
        else
        {
            return $this->_buffer->getBuffer($id);
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
        if (isset($this->_buffer))
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
     * @todo What must we exactly do here ?
     * 
     * @return string
     */
    public function get()
    {
        return $this->_b->get();
    }

    /**
     * 
     * @return string
     */
    public function startBuffer($type = PAF_Buffer_Interface::TYPE_MEMORY)
    {
        if (!isset($this->_buffer))
        {
            $this->_buffer = PAF_Buffer_Manager::factory($type);
            return $this->_buffer->id;
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
    public function stopBuffer($id = NULL)
    {
        if (!isset($this->_buffer))
        {
            throw new PAF_Exception_NoSuchIdentifier('No ' . $id . ' in buffer stack.');
        }
        elseif (NULL === $id || $id == $this->_buffer->id)
        {
            $out = $this->getBuffer();
            $this->dropBuffer();
            return $out;
        }
        else
        {
            return $this->_buffer->stopBuffer($id);
        }
    }

    /**
     * 
     * @return string
     */
    public function flush()
    {
        if (isset($this->_buffer))
        {
            $this->_pushDirect($this->_buffer->flush());
        }

        $out = $this->get();
        $this->_init();
        return $out;
    }
    
    public function hasBuffer()
    {
        return NULL !== $this->_buffer;
    }


}