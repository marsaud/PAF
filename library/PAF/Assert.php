<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_Assert
 *
 * @author fabrice
 */
class PAF_Assert
{
    const DEFAULT_MESSAGE = 'Assertion failed';
    
    public static function _($expression, $message = self::DEFAULT_MESSAGE)
    {
        if (!$expression)
        {
            throw new PAF_Exception_AssertionFailed($message);
        }
    }
}
