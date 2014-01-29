<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author fabrice
 */
interface PAF_Validator_Interface
{
    /**
     * @param mixed $value
     * 
     * @return boolean
     */
    public function validate($value);
}
