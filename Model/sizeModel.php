<?php

require_once __DIR__ . '/../Config/config.php';

class SizeModel
{

    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function getProductPrice($id_product, $size_name)
    {
        $sql = "SELECT ps.price 
            FROM product_sizes ps
            JOIN sizes s ON ps.id_size = s.id
            WHERE ps.id_product = ? AND s.name = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $id_product, $size_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $product_price = $result->fetch_assoc();

        return $product_price ? $product_price['price'] : null;
    }


    public function getSizeId($size_name)
    {
        $sql = "SELECT id FROM sizes WHERE name = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $size_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ? $row['id'] : null;
    }

}


