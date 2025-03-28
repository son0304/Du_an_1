<?php
require_once '../../Config/config.php';

class RegisterModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registerModel($name, $email, $password, $phone, $address) {
        // Check if email already exists
        $checkEmail = "SELECT id FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($checkEmail);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return false; // Email already exists
        }

        // Insert new user with role = 1
        $sql = "INSERT INTO users (name, email, password, phone, address, role) VALUES (?, ?, ?, ?, ?, 1)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $password, $phone, $address);
        
        if ($stmt->execute()) {
            return $this->conn->insert_id; // Return the ID of the newly created user
        }
        
        return false;
    }
}