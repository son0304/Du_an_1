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

            $checkContactStmt = $this->conn->prepare('SELECT id FROM contacts WHERE id_user = ?');
            $checkContactStmt->bind_param('i', $user['id']);
            $checkContactStmt->execute();
            $checkContactResult = $checkContactStmt->get_result();

            if ($checkContactResult->num_rows === 0) {
                
                $insertContactStmt = $this->conn->prepare('INSERT INTO contacts (id_user) VALUES (?)');
                $insertContactStmt->bind_param('i', $user['id']);
                $insertContactStmt->execute();
            }

            return $user;
        } else {
            return false;
        }
    }

    public function register($name, $email, $password, $phone, $address)
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

        $exists = $stmt->num_rows > 0;
        $stmt->close(); // ⚠️ thêm dòng này để tránh lỗi treo kết nối
        return $exists;
    }
}
