<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_Buffer_Memory_Simple
 *
 * @author fabrice
 */
class PAF_Buffer_MemorySimple extends PAF_Buffer_Abstract
{

    /**
     *
     * @var string
     */
    protected $_content;

    protected function _init()
    {
        parent::_init();
        $this->_reset();
    }

    protected function _reset()
    {
        $this->_content = '';
    }

    public function flush()
    {
        $out = $this->get();
        $this->_reset();
        return $out;
    }

    public function get()
    {
        return $this->_content;
    }

    public function pull($length = NULL, $piece = PAF_Buffer_Interface::LINE)
    {
        if (PAF_Buffer_Interface::BYTE === $piece)
        {
            return $this->_pullBytes($length);
        }
        elseif (PAF_Buffer_Interface::LINE === $piece)
        {
            return $this->_pullLines($length);
        }
        else
        {
            throw new PAF_Exception_IllegalArgument('Illegal pulling piece choice : ' . $piece);
        }
    }

    protected function _pullBytes($length = NULL)
    {
        NULL !== $length || $length = strlen($this->_content);

        $pulled = substr($this->_content, 0, $length);
        $kept = substr($this->_content, $length);
        $this->_content = $kept;
        return $pulled;
    }

    protected function _pullLines($length = NULL)
    {
        $lines = explode(PHP_EOL, $this->_content);

        NULL !== $length || $length = count($lines);

        $pulled = array_slice($lines, 0, $length);
        $kept = array_slice($lines, $length);

        $this->_content = implode(PHP_EOL, $kept);

        return implode(PHP_EOL, $pulled);
    }

    public function push($content)
    {
        $this->_content .= $content;
    }

}