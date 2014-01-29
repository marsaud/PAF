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
final class PAF_View_String extends PAF_View_Abstract
{
    const DEFAULT_CONTENT = '';
    
    /**
     *
     * @var string
     */
    protected $_content = '';

    /**
     * 
     * @param string $content
     * @param PAF_Stream_Interface $stream
     */
    public function __construct($content = self::DEFAULT_CONTENT, PAF_Stream_Interface $stream = NULL)
    {
        parent::__construct($stream);
        $this->push($content);
    }

    /**
     * 
     * @return void
     */
    protected function _initDefaultStream()
    {
        $this->_setStream(new PAF_Stream_PhpOutput());
    }

    /**
     * 
     * @return void
     */
    protected function _initProperties()
    {
        parent::_initProperties();

        $this->_extendReadProperties(array(
            'content' => 'content'
        ));
    }

    /**
     * 
     * @return void
     */
    public function render()
    {
        $this->_getStream()->put($this->content);
        $this->drop();
    }

    /**
     * 
     * @param string $content
     * 
     * @return void
     */
    public function push($content)
    {
        $this->_content .= (string) $content;
    }

    /**
     * 
     * @param string $content
     * 
     * @return void
     */
    public function append($content)
    {
        $this->push($content);
    }

    /**
     * 
     * @param string $content
     * 
     * @return void
     */
    public function unshift($content)
    {
        $this->_content = (string) $content . $this->_content;
    }

    /**
     * 
     * @param string $content
     */
    public function prepend($content)
    {
        $this->unshift($content);
    }

    /**
     * 
     * @return void
     */
    public function drop()
    {
        $this->_content = '';
    }

    /**
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->_content;
    }

}
