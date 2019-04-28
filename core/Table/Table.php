<?php

namespace Core\Table;
use Core\Database\MysqlDatabase;

class Table
{
    protected $table;
    protected $db;
    private $key;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
        if (is_null($this->table)) {
            $parts = explode('\\', get_class($this));
            $class_name = end($parts);
            $this->table = strtolower(str_replace('Table', '', $class_name));
        }
    }

    public function __get($key)
    {
        $method = 'get' . ucfirst($key);
        $this->key = $method();
        return $this->$key;

    }

    /**
     * query
     *
     * @param  string $statement
     * @param  array $attributes
     * @param  bool $one
     *
     * @return void
     */
    public function query(string $statement, array $attributes = null, bool $one = false)
    {
        if($attributes) {
            return $this->db->prepare($statement, $attributes, str_replace('Table', 'Entity', get_class($this)), $one);
        } else {
            return $this->db->query($statement, str_replace('Table', 'Entity', get_class($this)), $one);
        }

    }

    /**
     * update Update SQL statement.
     * @param int $id id of the record which we gonna update.
     * @param array $fields the fields we wanna update.
     * @return bool
     */
    public function update(int $id, array $fields): bool
    {
        $sql_parts = [];
        $attributes = [];
        foreach($fields as $k => $v) {
            $sql_parts[] = $k . ' = ?';
            $attributes[] = $v;
        }
        $attributes[] = $id;
        
        return $this->query('UPDATE ' . $this->table . ' SET ' . implode(',', $sql_parts) . ' WHERE id = ?', $attributes, true);
    }

    /**
     * delete DELETE a record from table
     * @param int $id id of the record wanted to delete
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->query('DELETE FROM ' . $this->table . ' WHERE id = ?', [$id], true);
    }

    /**
     * create INSERT SQL statement.
     * @param array $fields the fields we wanna update.
     * @return bool
     */
    public function create(array $fields): bool
    {
        \dump($fields);
        $sql_parts = [];
        $attributes = [];
        foreach($fields as $k => $v) {
            $sql_parts[] = $k . ' = ?';
            $attributes[] = $v;
        }
        \dump($attributes);
        
        $sql_parts = implode(',', $sql_parts);
        \dump($sql_parts);
        return $this->query('INSERT INTO ' . $this->table . ' SET ' . $sql_parts , $attributes, true);
    }

    /**
     * @param $key
     * @param $value
     * @return array
     */
    public function extract($key, $value): array
    {
        $records = $this->all();
        $return = [];
        foreach ($records as $v) {
            $return[$v->$key] = $v->$value;
        }
        return $return;
    }

    public function find(int $id)
    {
        return $this->query('SELECT * FROM ' . $this->table . ' WHERE id=?', [$id], true);
    }

    /**
     * all Get all records from a specific table
     *
     * @return array
     */
    public function all(): array
    {
        return $this->query('SELECT * FROM ' . $this->table);
    }

    /**
     * lastInsertId return the last id inserted into  a table
     * @return string
     */
    public function lastInsertId(): string
    {
        dump($this->db);
        return $this->db->lastInsertId();
    }
}