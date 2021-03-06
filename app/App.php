<?php

use Core\Config;
use Core\Database\MysqlDatabase;

class App
{
    public  $title = 'Mon site';
    private static $_instance;
    private $db_instance;

    /**
     * __construct class App is a Singleton class therefore should have a private class
     *
     * @return void
     */
    private function __construct()
    { }

    /**
     * geInstance return a singleton of the class App
     *
     * @return App
     */
    public static function getInstance(): App
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    /**
     * geTable a factory for creating new Tables
     * Factory for tables
     * @param string $name
     * @return mixed
     */
    public function getTable(string $name)
    {
        $table = ucfirst($name);
        $class_name = 'App\Table\\' . ucfirst($table) . 'Table';
        return new $class_name($this->getDb());
    }

    /**
     * getDb Singleton for the MysqlDatabase
     *
     * @return MysqlDatabase
     */
    public function getDb(): MysqlDatabase
    {
        $config = Config::getInstance(ROOT . '/config/config.php');
        if (is_null($this->db_instance)) {
            $this->db_instance = new MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
        }
        return $this->db_instance;
    }
}
