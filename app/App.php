<?php

use Core\Config;
use Core\Database\MysqlDatabase;

class App
{
    public  $title = 'Mon site';
    private static $_instance;
    private $db_instance;

    private function __construct()
    {
    }

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
     *
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
     * getDb
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

    public function forbidden()
    {
        header('HTTP/1.0 403 Forbidden');
        die('Access denied');

    }

    public function notFound()
    {
        header('HTTP/1.0 404 Not Found');
        die('Page introuvable');


    }

}