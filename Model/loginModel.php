<?php
require_once '../../Config/config.php';

class LoginModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function loginModel($email, $password) {
        // Truy vấn để lấy thêm address và phone
        $sql = "SELECT id, email, role, address, phone FROM users WHERE email = ? AND password = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Kiểm tra và đảm bảo các trường tồn tại
            return [
                'id' => $user['id'],
                'email' => $user['email'],
                'role' => $user['role'],
                'address' => $user['address'] ?? '',
                'phone' => $user['phone'] ?? ''
            ];
        }
        return false;
    }
}
