<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_Controller_TemplateLocator_Simple
 * 
 * @property string $path Description
 * @property string $extension Description
 *
 * @author fabrice
 */
class PAF_Controller_TemplateLocator_Simple extends PAF_Object_Base implements PAF_Controller_TemplateLocator_Interface
{

    const DEFAULT_PATH = '.';
    const DEFAULT_EXTENSION = 'phtml';

    /**
     *
     * @var string
     */
    protected $_path;

    /**
     *
     * @var string
     */
    protected $_extension;

    public function __construct($path = self::DEFAULT_PATH, $extension = self::DEFAULT_EXTENSION)
    {
        parent::__construct();

        $this->path = $path;
        $this->extension = $extension;
    }

    /**
     * 
     * @param string $path
     * 
     * @return void
     * 
     * @throws PAF_Exception_NoSuchResource
     */
    protected function _setPath($path)
    {
        if (!is_dir($path))
        {
            throw new PAF_Exception_NoSuchResource($path);
        }
        else
        {
            $this->_path = $path;
        }
    }

    /**
     * 
     * @todo Secure extension format
     * 
     * @param string $extension
     */
    protected function _setExtension($extension)
    {
        $this->_extension = $extension;
    }

    /**
     * 
     * @param string $action
     * 
     * @return string
     */
    public function get($action)
    {
        return $this->_path . DIRECTORY_SEPARATOR . $action . '.' . $this->_extension;
    }

    protected function _initProperties()
    {
        $this->_extendProperties(array(
            'path' => 'path',
            'extension' => 'extension'
        ));
    }

}
