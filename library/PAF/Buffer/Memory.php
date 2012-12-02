<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_Buffer_Memory
 *
 * @author fabrice
 * 
 * @property-read string $id The buffer id
 */
class PAF_Buffer_Memory implements PAF_Buffer_Interface, PAF_Bufferable_Interface
{

    /**
     *
     * @var PAF_Buffer_Memory
     */
    protected $_buffer;

    /**
     *
     * @var string
     */
    protected $_id;

    /**
     *
     * @var string
     */
    protected $_content;

    public function __construct()
    {
        $this->_id = uniqid();
        $this->_init();
    }

    protected function _init()
    {
        $this->_content = '';
    }

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

    protected function _pushDirect($content)
    {
        $this->_content .= $content;
    }

    public function dropBuffer($id = NULL)
    {
        if (!isset($this->_buffer))
        {
            throw new PAF_Exception_NoSuchIdentifier('No ' . $id . ' in buffer stack.');
        }
        elseif (NULL === $id || $this->_buffer->id == $id)
        {
            $this->_buffer = NULL;
        }
        else
        {
            $this->_buffer->dropBuffer($id);
        }
    }

    public function flushBuffer($id = NULL)
    {
        if (!isset($this->_buffer))
        {
            throw new PAF_Exception_NoSuchIdentifier('No ' . $id . ' in buffer stack.');
        }
        elseif (NULL === $id || $id = $this->_buffer->id)
        {
            $this->_pushDirect($this->_buffer->flush());
        }
        else
        {
            $this->_buffer->flushBuffer($id);
        }
    }

    public function getBuffer($id = NULL)
    {
        if (!isset($this->_buffer))
        {
            throw new PAF_Exception_NoSuchIdentifier('No ' . $id . ' in buffer stack.');
        }
        elseif (NULL === $id || $this->_buffer->id == $id)
        {
            return $this->_buffer->get();
        }
        else
        {
            return $this->_buffer->getBuffer($id);
        }
    }

    public function pull($length = NULL, $piece = PAF_Buffer_Interface::LINE)
    {
        if (PAF_Buffer_Interface::BYTE === $piece)
        {
            return $this->_pullBytes($length);
        }
        elseif (PAF_Buffer_Interface::LINE === $piece)
        {
            return $this->_pullLines($length);
        }
        else
        {
            throw new PAF_Exception_IllegalArgument('Unknown piece type "' . $piece . '" fro pulling.');
        }
    }
    
    protected function _pullBytes($length = NULL)
    {
        $pulled = substr($this->_content, 0, $length);
        $kept = substr($this->_content, $length);
        $this->_content = $kept;
        return $pulled;
    }
    
    /**
     * @todo
     * 
     * @param type $length
     */
    protected function _pullLines($length = NULL)
    {
        
    }

    public function get()
    {
        return $this->_content;
    }

    public function startBuffer()
    {
        if (!isset($this->_buffer))
        {
            $this->_buffer = new PAF_Buffer_Memory();
            return $this->_buffer->id;
        }
        else
        {
            return $this->_buffer->startBuffer();
        }
    }

    public function stopBuffer($id = NULL)
    {
        if (!isset($this->_buffer))
        {
            throw new PAF_Exception_NoSuchIdentifier('No ' . $id . ' in buffer stack.');
        }
        elseif (NULL === $id || $this->_buffer->id == $id)
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

    public function __get($name)
    {
        if ('id' !== $name)
        {
            throw new PAF_Exception_NoSuchProperty(__CLASS__ . ' has no ' . $name . ' read property.');
        }
        else
        {
            return $this->_id;
        }
    }

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

}