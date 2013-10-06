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
            throw new PAF_Exception_UnexistingBufferType();
        }
    }

    public static function start(PAF_Buffer_Interface $buffer, $type)
    {
        if ($buffer instanceof PAF_Buffer_AbleInterface)
        {
            return $buffer->startBuffer($type);
        }
        else
        {
            throw new PAF_Exception_NoBufferAvailable(); // @todo
        }
    }

    public static function drop(PAF_Buffer_Interface $buffer, $id)
    {
        if ($buffer->getId() == $id)
        {
            return NULL;
        }
        elseif (!$buffer instanceof PAF_Buffer_AbleInterface)
        {
            if (NULL === $id)
            {
                return NULL;
            }
            else
            {
                throw new PAF_Exception_NoSuchResource();
            }
        }
        else
        {
            $buffer->dropBuffer($id);
            return $buffer;
        }
    }

}