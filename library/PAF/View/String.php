<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_View_String
 *
 * @author fabrice
 * 
 * @property-read string $content The string content prepared for rendering
 */
class PAF_View_String implements PAF_View_Interface
{

    /**
     *
     * @var string
     */
    protected $_content = '';
    
    protected $_stream;
    
    public function __construct()
    {
        $this->_stream = new PAF_Stream_PhpOutput();
    }

    public function render()
    {
        $this->_stream->put($this->content);
        $this->drop();
    }

    public function push($content)
    {
        $this->_content .= (string) $content;
    }
    
    public function append($content)
    {
        return $this->push($content);
    }

    public function unshift($content)
    {
        $this->_content = (string) $content . $this->_content;
    }
    
    public function prepend($content)
    {
        return $this->unshift($content);
    }

    public function drop()
    {
        $this->_content = '';
    }

    public function __get($name)
    {
        if ('content' === $name)
        {
            return $this->_content;
        }
        else
        {
            throw new PAF_Exception_NoSuchProperty(
                    __CLASS__ . ' has no ' . $name . ' read property.'
                    );
        }
    }

    public function __toString()
    {
        return $this->content;
    }

}