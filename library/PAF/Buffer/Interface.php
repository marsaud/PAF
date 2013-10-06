<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author MAKRIS
 */
interface PAF_Buffer_Interface
{

    const BYTE = 'byte';
    const LINE = 'line';
    const TYPE_MEMORY = 'Memory';
    const TYPE_MEMORYSIMPLE = 'MemorySimple';

    public function push($content);

    public function pull($length = NULL, $piece = PAF_Buffer_Interface::LINE);

    public function flush();

    public function get();
}
