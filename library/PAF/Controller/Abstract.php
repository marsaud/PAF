<?php

/**
 *
 */

/**
 * Description of PAF_Controller_Abstract
 *
 * @property PAF_View_Interface $view A view linked with the current controller.
 * @property PAF_Container_Interface $container A container the controller
 * may ask for resoures.
 *
 * @author fabrice
 */
abstract class PAF_Controller_Abstract extends PAF_Object_Base implements
PAF_Controller_Interface
{

    /**
     *
     * @var PAF_View_Interface
     */
    protected $_view;

    /**
     *
     * @var PAF_Container_Interface
     */
    protected $_container;

    protected function _setView(PAF_View_Interface $view)
    {
        $this->_view = $view;
    }

    protected function _setContainer(PAF_Container_Interface $container)
    {
        $this->_container = $container;
    }

    protected function _initProperties()
    {
        $this->_extendProperties(array(
            'view' => 'view',
            'container' => 'container'
        ));
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function doAction($actionName)
    {
        if ('doAction' == $actionName
            || '_' == $actionName[0])
        {
            throw new PAF_Exception_IllegalArgument();
        }

        $methods = get_class_methods(get_class($this));

        if (!in_array($actionName, $methods))
        {
            throw new PAF_Exception_NoSuchAction();
        }

        $args = func_get_args();
        array_shift($args);
        call_user_func_array(array($this, $actionName), $args);
    }

}