<?php
require_once '../../Config/config.php';

<<<<<<< HEAD
class UserModel
{
  public $conn;
  public function __construct($db)
  {
    $this->conn = $db;
  }
  public function listUserModel()
  {
    $sql  = "SELECT*FROM users";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getUserById($id)
  {
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc(); // Trả về một hàng dữ liệu
  }
  public function createUserModel($name, $email, $password, $phone, $address, $role)
  {
    $role = intval($role);

    $sql = "INSERT INTO users (name, email, password, phone, address, role) VALUES (?,?,?,?,?,?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param('sssisi', $name, $email, $password, $phone, $address, $role); // Sửa 'sssiss' thành 'sssisi'

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function updateUserModel($id, $name, $email, $password, $phone, $address, $role)
  {
    $role = intval($role);

    $sql = "UPDATE users SET name = ?, email = ?, password = ?, phone = ?, address = ?, role = ? WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("sssisii", $name, $email, $password, $phone, $address, $role, $id);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteUserModel($id)
{
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
}
=======
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
>>>>>>> 294d0ce5651973c99dc7a54f79b0f0f9c3bc8737
