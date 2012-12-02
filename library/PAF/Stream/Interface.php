<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_Stream_Interface
 *
 * @author fabrice
 */
interface PAF_Stream_Interface
{

    const BYTE = 'byte';
    const LINE = 'line';

    public function open();

    public function close();

    public function put($content);

    public function get($length = NULL, $piece = PAF_Stream_Interface::LINE);
}
