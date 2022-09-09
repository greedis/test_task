<?php

namespace DolgoyAudiopunk\Logger;

class Logger extends Singleton
{
    public static function log($context)
    {
        self::method(require 'config/log.php')->writeLog(__FUNCTION__, $context);
    }

    public static function error($context)
    {
        self::method(require 'config/log.php')->writeLog(__FUNCTION__, $context);
    }

    public static function method($class)
    {
        $listenerClass = 'DolgoyAudiopunk\\Logger\\Methods\\' . ucfirst($class) . 'ClassFactory';

        if (class_exists($listenerClass)) {
            return $listenerClass::getInstance();
        } else {
            exit('This class does not exist!' . 'Class factory');
        }
        //file $class
    }
}