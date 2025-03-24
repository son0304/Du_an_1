<?php
require_once '../../Config/config.php' ;
class categoriesModel{
    public $conn;
    public function __construct($db){
        $this->conn = $db;
    }
    public function listCategories(){
        $sql = "SELECT * FROM categories";
        $result = $this->conn->query($sql);
        return $result;
    }
    public function createCategoryModel($name){
        $sql = "INSERT INTO categories (name) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        return $stmt->execute();
    }
}
?>