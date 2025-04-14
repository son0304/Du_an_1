<?php
require_once '../../Config/config.php';

class SettingModel
{
  public $conn;
  public function __construct($db)
  {
    $this->conn = $db;
  }
  public function listSettingModel()
  {
    $sql  = "SELECT*FROM settings";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function updateSettingModel($id, $set1, $set2, $set3, $set4, $set5)
  {

    $sql = "UPDATE settings SET set1 = ?, set2 = ?, set3 = ?, set4 = ?, set5 = ? WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("sssssi", $set1, $set2, $set3, $set4, $set5, $id);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getSettingById($id)
  {
    $sql = "SELECT * FROM settings WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();

  }


  public function deleteSettingModel($id)
  {
    $sql = "DELETE FROM settings WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
