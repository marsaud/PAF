<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_Form_View
 *
 * @property PAF_Object_DefaultNull $formData Description
 * @property PAF_Object_DefaultNull $formErrors Description
 *
 * @author fabrice
 */
class PAF_Form_View extends PAF_View_Template
{

    const NO_TEMPLATE = PAF_View_Template::NO_TEMPLATE;

    /**
     *
     * @var PAF_Object_DefaultNull
     */
    protected $_formData;

    /**
     *
     * @var PAF_Object_DefaultNull
     */
    protected $_formErrors;

    /**
     * 
     * @param string $template
     * @param PAF_Stream_Interface $stream
     */
    public function __construct($template = self::NO_TEMPLATE, PAF_Stream_Interface $stream = NULL)
    {
        parent::__construct($template, $stream);
    }

    /**
     * @return void
     */
    protected function _initProperties()
    {
        parent::_initProperties();

        $this->_extendProperties(array(
            'formErrors' => 'formErrors',
            'formData' => 'formData'
        ));
    }

    /**
     * @return PAF_Object_DefaultNull
     */
    protected function _getFormData()
    {
        return clone $this->_formData;
    }

    /**
     * 
     * @param PAF_Object_DefaultNull $formData
     * 
     * @return void
     */
    protected function setFormData(PAF_Object_DefaultNull $formData)
    {
        $this->_formData = $formData;
    }

    /**
     * 
     * @return PAF_Object_DefaultNull
     */
    protected function _getFormErrors()
    {
        return clone $this->_formErrors;
    }

    /**
     * 
     * @param PAF_Object_DefaultNull $formErrors
     * 
     * @return void
     */
    protected function _setFormErrors(PAF_Object_DefaultNull $formErrors)
    {
        $this->_formErrors = $formErrors;
    }

}
