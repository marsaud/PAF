<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_View_Abstract
 * 
 * @property-read PAF_Stream_Interface $stream The stream used to render view
 *
 * @author fabrice
 */
abstract class PAF_View_Abstract extends PAF_Object_Base implements PAF_View_Interface
{

    const DEFAULT_STREAM = NULL;
    
    /**
     *
     * @var PAF_Stream_Interface
     */
    private $_stream;

    /**
     * 
     * @return void
     */
    abstract protected function _initDefaultStream();

    /**
     * 
     * @return void
     */
    abstract public function render();

    /**
     * 
     * @param PAF_Stream_Interface $stream
     */
    public function __construct($stream = self::DEFAULT_STREAM)
    {
        parent::__construct();

        if (self::DEFAULT_STREAM !== $stream)
        {
            $this->_setStream($stream);
        }
        else
        {
            $this->_initDefaultStream();
        }
    }
    
    /**
     * 
     * @param PAF_Stream_Interface $stream
     * 
     * @return void
     */
    final protected function _setStream(PAF_Stream_Interface $stream)
    {
        $this->_stream = $stream;
    }
    
    /**
     * 
     * @return PAF_Stream_Interface
     */
    final protected function _getStream()
    {
        return $this->_stream;
    }

    /**
     * 
     * @return void
     */
    protected function _initProperties()
    {
        $this->_extendReadProperties(array(
            'stream' => 'stream'
        ));
    }

}
