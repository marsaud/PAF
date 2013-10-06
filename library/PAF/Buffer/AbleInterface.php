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

    public function startBuffer($type = NULL);

    public function stopBuffer($id = NULL);

    public function getBuffer($id = NULL);

    public function dropBuffer($id = NULL);

    public function flushBuffer($id = NULL);
    
    public function hasBuffer();
}
