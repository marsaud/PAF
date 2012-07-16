<?php

/**
 *
 */

/**
 * Description of PAF_View_interface
 *
 * View objects MAY implement this interface to ease controller writing.
 *
 * @author fabrice
 */
interface PAF_View_Interface
{
    /**
     * The content of the view is resolved and pushed to it's output stream.
     *
     * @return void
     */
    public function render();
}