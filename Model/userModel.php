<?php
require_once '../../Config/config.php';

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
    $stmt->bind_param('sssssi', $name, $email, $password, $phone, $address, $role); // Sửa 'sssiss' thành 'sssisi'

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
    $stmt->bind_param("sssssii", $name, $email, $password, $phone, $address, $role, $id);

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