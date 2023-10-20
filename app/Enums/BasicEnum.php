<?php

namespace App\Enums;

use ReflectionClass;
abstract class BasicEnum
{
    private static $constCacheArray = null;
    public static function getConstants()
    {
        if (is_null(self::$constCacheArray)) {
            self::$constCacheArray = [];
        }

        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }

        return self::$constCacheArray[$calledClass];
    }
}
