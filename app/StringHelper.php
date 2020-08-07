<?php


namespace App;


class StringHelper
{
    public static function checkEmpty($value) {
        if(!isset($value))
            return true ;
        if($value === null )
            return true;
        if(is_array($value) && count($value) == 0)
            return true;
        if(is_string($value) &&trim($value) === "")
            return true;

        return false;
    }
    static function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    static function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }
}
