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
interface PAF_Controller_TemplateLocator_Interface
{
    /**
     * @param string $action Description
     * 
     * @return string A template file URI
     */
    public function get($action);
}
