<?php

/**
 *
 */

/**
 * Description of PAF_Controller_Interface
 *
 * Controllers MAY implement this interface to ease application writing.
 *
 * @author fabrice
 */
interface PAF_Controller_Interface
{
    /**
     * Perform an action assumed to be available in the controller.
     *
     * @param string $actionName The name of the action to do.
     *
     * @return void
     *
     * @throws PAF_Exception_NoSuchIdentfier if the action name is not known in
     * the scope of this controller.
     */
    public function doAction($actionName);
}