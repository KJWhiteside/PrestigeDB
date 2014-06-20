<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class Enum
{

    private static $constCache = NULL;

    private static function getConstants()
    {
        if (self::$constCache === NULL)
        {
            $reflect = new ReflectionClass(get_called_class());
            self::$constCache = $reflect->getConstants();
        }

        return self::$constCache;
    }

    public static function isValidName($name, $strict = false)
    {
        $constants = self::getConstants();

        if ($strict)
        {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function isValidValue($value)
    {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict = true);
    }

}

abstract class PermissionLevel extends Enum {
    const DOMAIN = 0;
    const REGIONAL = 1;
    const NATIONAL = 2;
}

abstract class PrestigeType extends Enum {
    const GENERAL = 0;
    const REGIONAL = 1;
    const NATIONAL = 2;
}

abstract class ExceptionLevel extends Enum {
    const DOMAIN_OFFICER = 0;
    const DOMAIN_SIGNIFICANT_OTHER = 1;
    const REGIONAL_OFFICER = 2;
    const REGIONAL_SIGNIFICANT_OTHER = 3;
    const NATIONAL_OFFICER = 4;
    const NATIONAL_SIGNIFICANT_OTHER = 5;
}