<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author MAKRIS
 */
interface PAF_Buffer_AbleInterface
{
    /**
     * Creates buffer
     * 
     * @return void
     */
    public function startBuffer();

    /**
     * Destroys buffer
     * 
     * @return string Buffer's last content
     */
    public function stopBuffer();

    /**
     * @return string Buffer's content
     */
    public function getBuffer();

    /**
     * Destroys buffer
     * 
     * @return void
     */
    public function dropBuffer();

    /**
     * Buffer's content goes where it had to go if not being buffered.
     * 
     * @return void
     */
    public function flushBuffer();
    
    /**
     * Wether a buffer exists or not
     * 
     * @return boolean
     */
    public function hasBuffer();
}
