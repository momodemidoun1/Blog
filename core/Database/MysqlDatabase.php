<?php

namespace Core\Database;
use \PDO;

class MysqlDatabase extends Database
{
      private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;

    public function __construct(string $db_name, string $db_user = 'root', string $db_pass = '', string $db_host = 'localhost')
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    /**
     * getPDO Sends the instance of PDO.
     *
     * @return PDO
     */
    private function getPDO (): PDO
    {
        if ($this->pdo === null) {
            $pdo = new PDO('mysql:dbname=blog;host=localhost', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    /**
     * query Executes an SQL statement, returning a result set as a PDOStatement object or an array of it.
     *
     * @param  string $statement
     * @param bool $one
     * @param string $class_name
     * @return array
     */
    public function query (string $statement, string $class_name = null, bool $one = false): array
    {    
        $req = $this->getPDO()->query($statement);
        if (
            strpos($statement, 'UPDATE') === 0 || 
            strpos($statement, 'INSERT') === 0 || 
            strpos($statement, 'DELETE') === 0 
            ) {
            return $req;
        }
        if ($class_name === null) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if($one) {
            $datas = $req->fetch();
        } else {
            $datas = $req->fetchAll();
        }
        return $datas;
    }

    /**
     * prepare prepare statement
     *
     * @param string $statement
     * @param array $attributes
     * @param string $class_name
     * @param bool $one
     * @return array|bool|mixed
     */
    public function prepare(string $statement, array $attributes, string $class_name = null, bool $one = false)
    {
        $req = $this->getPDO()->prepare($statement);
        $res = $req->execute($attributes);  
        if (
            strpos($statement, 'UPDATE') === 0 || 
            strpos($statement, 'INSERT') === 0 || 
            strpos($statement, 'DELETE') === 0 
            ) {
            return $res;
        }

        if ($class_name === null) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if ($one) {
            $datas = $req->fetch();
        } else {
            $datas = $req->fetchAll();
        }
        return $datas;
    }

    /**
     * lastInsertId return the last id inserted into  a table
     * @return string
     */
    public function lastInsertId(): string
    {
        return $this->getPDO()->lastInsertId();
    }
}