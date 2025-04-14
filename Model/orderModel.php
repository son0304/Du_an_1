<?php

require_once '../../Config/config.php';

class OrderModel {

    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function listOrderModel() {
        $sql = 'SELECT o.id, o.name, o.address, o.phone, o.status, o.created_at, u.name AS user_name, pz.id_product AS pz_product, pz.id_size AS pz_size, pz.price AS pz_price
        FROM orders o
        JOIN users u ON o.id_user = u.id
        JOIN product_sizes pz ON o.id_productsize = pz.id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function createOrderModel($id_user, $name, $phone, $address, $total_price,$cart_item, $status, $created_at) {
        $sql = "INSERT INTO orders (id_user, name, phone, address, total_price, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isssdss", $id_user, $name, $phone, $address, $total_price, $status, $created_at);
        $stmt->execute();
        $id_order = $this->conn->insert_id;
        foreach ($cart_item as $item) {
            $id_product = $item['id_product'];
            $quantity = $item['quantity'];
            $id_size = $item['id_size'];
            $price = $item['price'];
            $sql = "INSERT INTO order_details (id_order, id_product, quantity, id_size, price) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iiiss", $id_order, $id_product, $quantity, $id_size, $price);
            $stmt->execute();
        }
    }

    

    
    
}