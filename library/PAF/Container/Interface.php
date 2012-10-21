<?php

/**
 *
 */

/**
 * Description of PAF_Container_Interface
 *
 * Resource containers objects MAY implement this interface to ease writing
 * application components with resource sharing needs.
 *
 * @author fabrice
 */
interface PAF_Container_Interface
{
    /**
     * Gives back a determined resoucre identified by it's name.
     *
     * @param string $resourceName The unique name/id of a resoucre assumed to
     * be held by the container.
     *
     * @return mixed The resource asked for.
     *
     * @throws PAF_Exception_NoSuchIdentifier if the resource name is not known
     * in the scope of this container.
     *
     */
    public function get($resourceName);
}