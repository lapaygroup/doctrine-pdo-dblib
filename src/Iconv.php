<?php

namespace LapayGroup\DoctrinePdoDblib;

class Iconv
{
    public static function toUtf8Arr($raw)
    {
        return array_map('self::toUtf8', $raw);
    }

    public static function toCp1251Arr($raw)
    {
        return array_map('self::toCp1251', $raw);
    }

    public static function toUtf8($string)
    {
        if ($string === 0 || $string === '0') return 0;
        if (empty($string)) return Null;
        return iconv('CP1251', 'UTF-8', $string);
    }

    public static function toCp1251($string)
    {
        if ($string === 0 || $string === '0') return 0;
        if (empty($string)) return Null;
        return iconv('UTF-8', 'CP1251', $string);
    }
}
