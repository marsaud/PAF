<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_Controller_Front_Cli
 *
 * @author fabrice
 */
class PAF_Controller_Front_Cli extends PAF_Controller_Front_Abstract
{

    /**
     *
     * @var array
     */
    protected $_arguments;

    public function pump()
    {
        $arguments = $argv;
        $this->_arguments = $this->_structureArguments($argc, $arguments);
    }

    protected function _structureArguments($count, $arguments)
    {
        $structuredArguments = array(
            'params' => array()
        );

        $pos = 0;
        $optionsTerminated = false;

        while ($pos < $count)
        {
            $item = $arguments[$pos];
            if ($optionsTerminated)
            {
                $structuredArguments['params'][] = $item;
                $pos++;
            }
            elseif ($this->_isShortOption($item) || $this->_isLongOption($item))
            {
                if ((1 + $pos) < $count)
                {
                    $nextItem = $arguments[$pos + 1];
                    if ($this->_isNotValue($nextItem))
                    {
                        $structuredArguments[$item] = NULL;
                        $pos++;
                    }
                    else
                    {
                        $structuredArguments[$item] = $nextItem;
                        $pos += 2;
                    }
                }
                else
                {
                    $structuredArguments[$item] = NULL;
                    $pos++;
                }
            }
            elseif ($this->_isOptionTerminator($item))
            {
                $optionsTerminated = true;
                $pos++;
            }
            else
            {
                $structuredArguments['params'][] = $item;
                $pos++;
            }
        }
        
        return $structuredArguments;
    }

    protected function _isShortOption($item)
    {
        return (2 === strlen($item) && '-' === $item[0]);
    }

    protected function _isLongOption($item)
    {
        return (3 <= strlen($item) && '-' === $item[0] && '-' === $item[1]);
    }

    protected function _isNotValue($item)
    {
        return $this->_isOptionTerminator($item) ||
                $this->_isShortOption($item) ||
                $this->_isLongOption($item);
    }

    protected function _isOptionTerminator($item)
    {
        return '--' === $item;
    }

}
