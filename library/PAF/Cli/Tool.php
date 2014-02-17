<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_Cli_Tool
 *
 * @author fabrice
 */
class PAF_Cli_Tool
{

    public function structureArguments($arguments)
    {
        $count = count($arguments);
        $orderedArguments = array_values($arguments);

        $structuredArguments = array(
            'params' => array()
        );

        $pos = 0;
        $optionsTerminated = false;

        while ($pos < $count)
        {
            $item = $orderedArguments[$pos];
            if ($optionsTerminated)
            {
                $structuredArguments['params'][] = $item;
                $pos++;
            }
            elseif ($this->isShortOption($item) || $this->isLongOption($item))
            {
                $this->_tryHookValue(
                        $orderedArguments, $count, $item, $pos, $structuredArguments
                        );
            }
            elseif ($this->isOptionTerminator($item))
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

    private function _tryHookValue($orderedArguments, $count, $item, &$pos, &$structuredArguments)
    {
        if ((1 + $pos) < $count)
        {
            $nextItem = $orderedArguments[$pos + 1];
            if ($this->isNotValue($nextItem))
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

    public function isShortOption($item)
    {
        return (2 === strlen($item) && '-' === $item[0] && '-' !== $item[1]);
    }

    public function isLongOption($item)
    {
        return (3 <= strlen($item) && '-' === $item[0] && '-' === $item[1]);
    }

    public function isNotValue($item)
    {
        return $this->isOptionTerminator($item) ||
                $this->isShortOption($item) ||
                $this->isLongOption($item);
    }

    public function isOptionTerminator($item)
    {
        return '--' === $item;
    }

}
