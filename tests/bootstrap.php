<?php

/**
 *
 */

/**
 * @author fabrice
 */
ini_set('include_path', implode(PATH_SEPARATOR, array(
    ini_get('include_path'),
    '/usr/share/php/PHPUnit',
    realpath(dirname(__FILE__) . '/../library')
)));

class AutoloadForTest
{
    public static function autoload($class)
    {
        if (strrpos($class, 'PAF') !== 0)
        {
            throw new Exception('Not PAF class');
        }
        $classFile = str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
        require_once $classFile;
        if (!class_exists($class, false) && !interface_exists($class, false))
        {
            throw new Exception('Class (or interface) not found');
        }

    }
}

spl_autoload_register(array('AutoloadForTest', 'autoload'));