<?php
require_once __DIR__ . '/../Config/config.php';

class RegisterModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function registerModel($name, $email, $password, $phone, $address)
    {
        // Insert new user with role = 0
        $sql = "INSERT INTO users (name, email, password, phone, address, role) VALUES (?, ?, ?, ?, ?, 0)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $password, $phone, $address);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function isNameExists($name)
    {
        $sql = "SELECT id FROM users WHERE name = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows > 0;
    }
}
