<?php
require_once '../../Config/config.php';

class ProductModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function listProductModel()
    {
        $sql = "SELECT p.id, p.name, p.description, p.img, c.name AS category_name 
        FROM products p
        JOIN categories c ON p.id_category = c.id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result(); // Lấy kết quả từ truy vấn

        return $result->fetch_all(MYSQLI_ASSOC); // Dùng fetch_all thay vì fetchAll()
    }

    public function createProductModel($name, $description, $id_category, $img)
    {
        $sql = "INSERT INTO products (name, description, id_category, img) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssis", $name, $description, $id_category, $img); // Sửa thứ tự: s = string, i = integer
        return $stmt->execute();
    }
    public function getCategories()
    {
        $sql = "SELECT id, name FROM categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function deleteProductModel($id)
    {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function updateProductModel($id, $name, $description, $id_category, $img)
    {
        $sql = "UPDATE products SET name = ?, description = ?, id_category = ?, img = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $description, $id_category, $img, $id);
        $stmt->execute();
    }
    public function detailProductModel($id)
    {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
