<?php
require_once '../../Config/config.php';

class LoginModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function loginModel($email, $password) {
        // Truy vấn không sử dụng mã hóa password
        $sql = "SELECT id, email, role FROM users WHERE email = ? AND password = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return false;
    }
}
