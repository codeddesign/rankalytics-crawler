<?php

class Config
{
    public static $google = array(
        'tld' => 'com',
        'lang' => 'en',
        'geo' => 'en'
    );

    public static function getGoogle($key)
    {
        if (!isset(self::$google[$key])) {
            exit('Config: google[' . $key . '] does not exist');
        }

        return self::$google[$key];
    }
}