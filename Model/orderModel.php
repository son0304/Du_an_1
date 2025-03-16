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

    public function createOrderModel($id_user, $id_productsize, $name, $address, $phone, $status, $create_at) {
        $sql = 'INSERT INTO orders (id_user, id_productsize, name, address, phone, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iisssss', $id_user, $id_productsize, $name, $address, $phone, $status, $create_at);
        return $stmt->execute();
    }

    public function getUsers() {
        $sql = 'SELECT id, name FROM users';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductSizes() {
        $sql = 'SELECT id, id_product, id_size, price FROM product_sizes';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

