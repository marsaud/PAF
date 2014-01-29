<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_Validator_NotEmptyString
 *
 * @author fabrice
 */
class PAF_Validator_NotEmptyString implements PAF_Validator_Interface
{

    public function validate($value)
    {
        return is_string($value) && ('' !== $value);
    }

}
