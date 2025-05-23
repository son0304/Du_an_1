<?php

require_once __DIR__ . '/../Config/config.php';


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

    public function getOrdersModel() {}
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
    public function searchOrder($search, $status = null)
    {
        // ⚠️ Thay 'name' nếu tên cột người nhận là khác
        $sql = "SELECT * FROM orders WHERE (CAST(id AS CHAR) LIKE ? OR name LIKE ?)";

        if (!empty($status)) {
            $sql .= " AND status = ?";
        }

        $sql .= " ORDER BY received_date ASC, received_time ASC";

        if (!empty($status)) {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sss", $search, $search, $status);
        } else {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $search, $search);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function searchOrderByUser($id_user, $search, $status = null)
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
                  AND (CAST(o.id AS CHAR) LIKE ? OR p.name LIKE ?)";

        // Nếu có lọc theo status
        if (!empty($status)) {
            $sql .= " AND o.status = ?";
        }

        $sql .= " ORDER BY o.created_at DESC, od.id ASC";

        // Chuẩn bị câu lệnh
        if (!empty($status)) {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("isss", $id_user, $search, $search, $status);
        } else {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iss", $id_user, $search, $search);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    // Model/OrderModel.php



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

    public function updateStatusOrderModel($id_order, $status)
    {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $status, $id_order);
        $stmt->execute();
    }

    public function updateOrderModel($id_order, $name, $phone, $address, $date, $time, $payment)
    {
        $sql = "UPDATE orders 
                SET 
                    name = ?, 
                    phone = ?, 
                    address = ?, 
                    received_date = ?, 
                    received_time = ?, 
                    payment = ? 
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssi", $name, $phone, $address, $date, $time, $payment, $id_order);
        $stmt->execute();
    }
}
