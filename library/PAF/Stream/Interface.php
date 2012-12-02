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

interface PAF_Buffer_Interface
{

    const BYTE = 'byte';
    const LINE = 'line';

    public function push($content);

    public function pull($length = NULL, $piece = PAF_Buffer_Interface::LINE);

    public function flush();

    public function get();
}

interface PAF_Bufferable_Interface
{

    public function startBuffer();

    public function stopBuffer($id = NULL);

    public function getBuffer($id = NULL);

    public function dropBuffer($id = NULL);

    public function flushBuffer($id = NULL);
}