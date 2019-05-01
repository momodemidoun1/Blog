<?php
namespace Core\Database;

class QueryBuilder 
{
    private $db;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    public function select() 
    {
    }   

    public function where($contidion)
    {
        return 'WHERE ' . $contidion; 
    }

    public function from($tables)
    {
    }
}