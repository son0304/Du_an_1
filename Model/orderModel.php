<?php

require_once '../../Config/config.php';

class OrderModel
{

    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function listOrderModel()
    {
        $sql = "SELECT * FROM orders ORDER BY received_date ASC, received_time ASC";


        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }




    //=================Client=====================
    public function getOrdersByUserId($id_user)
    {
        $sql = "SELECT 
        od.id AS order_detail_id,
        od.id_order,
        od.id_product,
        od.id_size,
        od.quantity,
        od.price AS unit_price,
    
        o.id_user,
        o.total_price,
        o.status,
        o.created_at,
        o.received_date,
        o.payment,
        o.received_time,
    
        p.name AS product_name,
        p.img AS product_image

    
        FROM order_details od
        INNER JOIN orders o ON od.id_order = o.id
        INNER JOIN products p ON od.id_product = p.id
    
        WHERE o.id_user = ?
        ORDER BY o.created_at DESC, od.id ASC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }



    public function getOrderById($id_order)
    {
        $sql = "
        SELECT 
        od.id AS order_detail_id,
        od.id_order,
        od.id_product,
        od.id_size,
        od.quantity,
        od.price AS unit_price,
    
        o.id_user,
        o.total_price,
        o.status,
        o.created_at,
        o.name AS customer_name,
        o.address,
        o.phone,
        o.received_date,
        o.payment,
        o.received_time,
    
        p.name AS product_name,
        p.description AS product_description,
        p.img AS product_image
    
        FROM order_details od
        INNER JOIN orders o ON od.id_order = o.id
        INNER JOIN products p ON od.id_product = p.id
    
        WHERE od.id_order = ?
        ORDER BY od.id ASC;
        ";


        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_order);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createOrderModel($id_user, $name, $phone, $address, $total_price, $cart_item, $status, $created_at, $received_date, $payment, $received_time)
    {
        $sql = "INSERT INTO orders (id_user, name, phone, address, total_price, status, created_at,received_date, payment, received_time) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isssdsssss", $id_user, $name, $phone, $address, $total_price, $status, $created_at, $received_date, $payment, $received_time);
        if ($stmt->execute()) {
            $id_order = $this->conn->insert_id;
            foreach ($cart_item as $item) {
                $sql_detail = "INSERT INTO order_details (id_order, id_product, quantity, price, id_size) 
                               VALUES (?, ?, ?, ?, ?)";
                $stmt_detail = $this->conn->prepare($sql_detail);
                $stmt_detail->bind_param("iiisi", $id_order, $item['id_product'], $item['quantity'], $item['price'], $item['id_size']);
                $stmt_detail->execute();
            }
            return $id_order;
        } else {
            return false;
        }
    }
}