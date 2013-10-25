<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PAF_Buffer_Factory
 *
 * @author fabrice
 */
class PAF_Buffer_Manager
{

    protected static $_types = array(
        PAF_Buffer_Interface::TYPE_MEMORY,
        PAF_Buffer_Interface::TYPE_MEMORYSIMPLE
    );

    public static function factory($type)
    {
        self::_checkType($type);
        $class = 'PAF_Buffer_' . $type;
        return new $class();
    }

    protected static function _checkType($type)
    {
        if (!in_array($type, self::$_types))
        {
            throw new PAF_Exception_IllegalArgument('Unexisting buffer type');
        }
    }

    public static function start(PAF_Buffer_Interface $buffer, $type)
    {
        if ($buffer instanceof PAF_Buffer_AbleInterface)
        {
            $buffer->startBuffer($type);
        }
        else
        {
            throw new PAF_Exception_MissingResource('No buffer available');
        }
    }

    public static function drop(PAF_Buffer_Interface $buffer)
    {
        if ($buffer instanceof PAF_Buffer_AbleInterface && $buffer->hasBuffer())
        {
            return $buffer->dropBuffer();
        }
        else
        {
            return NULL;
        }
    }
    
    public static function stop(PAF_Buffer_Interface $buffer, &$content)
    {
        if ($buffer instanceof PAF_Buffer_AbleInterface && $buffer->hasBuffer())
        {
            $content = $buffer->stopBuffer();
            return $buffer;
        }
        else
        {
            $content = $buffer->get();
            return NULL;
        }
    }

}