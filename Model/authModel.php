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
            //Đăng nhập tcong sẽ thêm mới giỏi hàng với id_user tương úng

            //Kiểm tra xem c chacha
            $checkStmt = $this->conn->prepare('SELECT id FROM carts WHERE id_user = ?');
            $checkStmt->bind_param('i', $user['id']);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows === 0) {
                // Chưa có giỏ hàng => tạo mới
                $insertStmt = $this->conn->prepare('INSERT INTO carts (id_user) VALUES (?)');
                $insertStmt->bind_param('i', $user['id']);
                $insertStmt->execute();
            }

            return $user;
        } else {
            return false;
        }
    }
}
