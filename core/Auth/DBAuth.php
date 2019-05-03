<?php


namespace Core\Auth;


use Core\Database\MysqlDatabase;

class DBAuth
{
    private $db;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    public function getUserId()
    {
        if ($this->logged()) {
            return $_SESSION['auth'];
        } else {
            return false;
        }
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login(string $username, string $password): bool
    {
        $user = $this->db->prepare("SELECT * FROM users WHERE username =?", [$username],null, true);
        if ($user) {
            if ($user->password === sha1($password)) {
                session_start();
                $_SESSION['auth'] = $user->id;
                return true;
            }
        }
        return false;
    }

    public function logged()
    {
        return isset($_SESSION['auth']);
    }


}