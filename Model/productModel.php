<?php
require_once '../../Config/config.php';

class ProductModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy danh sách sản phẩm
    public function listProductModel()
    {
        $sql = "SELECT p.id, p.name, p.description, p.img, c.name AS category_name 
<<<<<<< HEAD
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
=======
                FROM products p
                JOIN categories c ON p.id_category = c.id 
                ORDER BY p.id ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Tạo sản phẩm mới
    public function createProductModel($name, $description, $id_category, $img, $sizes)
    {
        $sql = "INSERT INTO products (name, description, id_category, img) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssis", $name, $description, $id_category, $img);
        $stmt->execute();
        $id_product = $this->conn->insert_id;

        if (!empty($sizes) && is_array($sizes)) {
            foreach ($sizes as $size_name => $price) {
                $id_size = $this->getSizeId($size_name) ?? $this->insertSize($size_name);
                $this->insertProductSize($id_product, $id_size, $price);
            }
        }
        return true;
    }

    // Lấy ID của size nếu tồn tại
    public function getSizeId($size_name)
    {
        $sql = "SELECT id FROM sizes WHERE name = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $size_name);
        $stmt->execute();
        $stmt->bind_result($id_size);

        $id_size = null;
        if ($stmt->fetch()) {
            return $id_size;
        }

        return null;
    }

    // Thêm size mới
    private function insertSize($size_name)
    {
        $sql = "INSERT INTO sizes (name) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $size_name);
        $stmt->execute();
        return $this->conn->insert_id;
    }

    // Thêm vào bảng product_sizes
    private function insertProductSize($id_product, $id_size, $price)
    {
        $sql = "INSERT INTO product_sizes (id_product, id_size, price) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iid", $id_product, $id_size, $price);
        $stmt->execute();
    }

    // Lấy danh sách danh mục
>>>>>>> 00461e801bb6200557a4d064d6444f2aa39da0f5
    public function getCategories()
    {
        $sql = "SELECT id, name FROM categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Xóa sản phẩm
    public function deleteProductModel($id)
    {
<<<<<<< HEAD
=======
        $sql = "DELETE FROM product_sizes WHERE id_product = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

>>>>>>> 00461e801bb6200557a4d064d6444f2aa39da0f5
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
<<<<<<< HEAD
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
=======

        // Xóa size không còn sử dụng
        $sql = "DELETE FROM sizes WHERE id NOT IN (SELECT DISTINCT id_size FROM product_sizes)";
        $this->conn->query($sql);
    }

    // Cập nhật sản phẩm
    public function updateProductModel($id, $name, $description, $id_category, $img, $sizes)
    {
        if ($img) {
            $sql = "UPDATE products SET name = ?, description = ?, id_category = ?, img = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssi", $name, $description, $id_category, $img, $id);
        } else {
            $sql = "UPDATE products SET name = ?, description = ?, id_category = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssi", $name, $description, $id_category, $id);
        }
        $stmt->execute();

        // Xóa size cũ
        $sql = "DELETE FROM product_sizes WHERE id_product = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if (!empty($sizes) && is_array($sizes)) {
            foreach ($sizes as $size_name => $price) {
                $id_size = $this->getSizeId($size_name) ?? $this->insertSize($size_name);
                $this->insertProductSize($id, $id_size, $price);
            }
        }
        return true;
>>>>>>> 00461e801bb6200557a4d064d6444f2aa39da0f5
    }
}
