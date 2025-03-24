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
            JOIN categories c ON p.id_category = c.id 
            ORDER BY p.id ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();


        return $result->fetch_all(MYSQLI_ASSOC); 
    }

    public function createProductModel($name, $description, $id_category, $img, $size)
    {
        $sql = "INSERT INTO products (name, description, id_category, img) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssis", $name, $description, $id_category, $img);
        $stmt->execute();
        $id_product = $this->conn->insert_id;

        foreach ($size as $size_name => $price) {
            $id_size = $this->getSizeId($size_name);
            if (!$id_size) {
                $sql = "INSERT INTO sizes (name) VALUES (?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("s", $size_name);
                $stmt->execute();
                $size_id = $this->conn->insert_id;
            }

            $sql = "INSERT INTO product_sizes (id_product, id_size, price) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iii", $id_product, $size_id, $price);
            $stmt->execute();
        }

        return $stmt->execute();
    }

    public function getSizeId($size_name) {}
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
        $dele_product_sizes = "DELETE FROM product_sizes WHERE id_product = ?";
        $stmt = $this->conn->prepare($dele_product_sizes);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $delete_product = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($delete_product);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $delte_size = "DELETE FROM sizes WHERE id NOT IN (SELECT DISTINCT id_size FROM product_sizes)";
        $this->conn->query($delte_size);
    }

    public function updateProductModel($id, $name, $description, $id_category, $img, $size)
    {
        if ($img) {
            $sql = "UPDATE products SET name = ?, description = ?, id_category = ?, img = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssi", $name, $description, $id_category, $img, $id);
            $stmt->execute();
        } else {
            $sql = "UPDATE products SET name = ?, description = ?, id_category = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssi", $name, $description, $id_category, $id);
            $stmt->execute();
        }


        if (empty($size) || !is_array($size)) {
            return true;
        }
        $deleP_s = "DELETE FROM product_sizes WHERE id_product = ?";
        $stmt = $this->conn->prepare($deleP_s);
        $stmt->bind_param('i', $id);
        $stmt->execute();


        foreach ($size as $size_name => $price) {
            $id_size = $this->getSizeId($size_name);


            if (!$id_size) {
                $sql = "INSERT INTO sizes (name) VALUES (?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("s", $size_name);
                $stmt->execute();
                $id_size = $this->conn->insert_id;
            }


            $insert_size = "INSERT INTO product_sizes (id_product, id_size, price) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($insert_size);
            $stmt->bind_param("iid", $id, $id_size, $price);
            $stmt->execute();
        }

        return true;
    }
}
