<?php
require_once '../../Config/config.php' ;

class UserModel{
  private $conn;
  public function __construct($db) {
    $this->conn = $db;
    
}
public function listUserModel() {
  $sql = "SELECT id, name, email, phone, address, role FROM users";
  
  $stmt = $this->conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();

  return $result->fetch_all(MYSQLI_ASSOC);
}
public function getUserById($id) {
  $sql = "SELECT id, name, email, phone, address, role FROM users WHERE id = ?";
  $stmt = $this->conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  return $stmt->get_result()->fetch_assoc();
}

// Cập nhật thông tin người dùng
public function updateUser($id, $name, $email, $phone, $address) {
  $sql = "UPDATE users SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?";
  $stmt = $this->conn->prepare($sql);
  $id = (int) $id; // Ép kiểu id thành số nguyên
  $stmt->bind_param("ssssi", $name, $email, $phone, $address, $id);
  return $stmt->execute();
}
public function deleteUser($id) {
  $sql = "DELETE FROM users WHERE id = ?";
  $stmt = $this->conn->prepare($sql);
  
  // Kiểm tra xem câu lệnh chuẩn bị có thành công không
  if ($stmt === false) {
      die('Câu lệnh chuẩn bị không thành công: ' . htmlspecialchars($this->conn->error));
  }

  // Liên kết tham số
  $stmt->bind_param("i", $id);
  
  // Thực thi câu lệnh
  return $stmt->execute();
}

}