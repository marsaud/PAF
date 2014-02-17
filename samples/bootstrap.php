<?php

/**
 *
 */
/**
 * @author fabrice
 */
ini_set(
        'include_path', implode(
                PATH_SEPARATOR, array(
    ini_get('include_path'),
    realpath(dirname(__FILE__) . '/../library')
                )
        )
);

class AutoloadForTest
{

    public static function autoload($class)
    {
        if (strrpos($class, 'PAF') !== 0)
        {
            return;
        }
        $classFile = str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
        require_once $classFile;
        if (!class_exists($class, false) && !interface_exists($class, false))
        {
            throw new Exception('PAF Class (or Interface) not found : ' . $class);
        }
    }

}

spl_autoload_register(array('AutoloadForTest', 'autoload'));
