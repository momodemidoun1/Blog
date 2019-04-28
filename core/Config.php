<?php
namespace Core;

class Config
{

    private $setting = [];
    private static $_instance;

    private function __construct($file)
    {
        $this->id = uniqid();
        $this->setting = require $file;
    }

    /**
     * getInstance return the singleton of class Config
     *
     * @return Config
     */
    public static function getInstance($file): Config
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Config($file);
        }
        return self::$_instance;
    }

    /**
     * get return a key of the $setting config array
     *
     * @param string $key
     * @return string | null
     */
    public function get(string $key): ?string
    {
        if (!isset($key)) {
            return null;
        }
        return $this->setting[$key];
    }

}

