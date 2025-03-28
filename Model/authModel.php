<?php

require_once __DIR__ . '/../Config/config.php';

class AuthModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login($name, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if (!$user) {
            return false;
        }

        if ($user['password'] === $password) {
            return $user;
        } else {
            return false;
        }
    }
}
