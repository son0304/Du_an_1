<?php

require_once __DIR__ . '/../Model/orderModel.php';

class OrderController {
    private $orderModel;

    public function __construct($db) {
        $this->orderModel = new OrderModel($db);
    }
    public function listOrder() {
        $order = $this->orderModel->listOrderModel();
        include_once __DIR__ . '/../View/Admin/orders/listOrder.php';
    }

    public function createOrder() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_user = $_POST['id_user'];
            $id_productsize = $_POST['id_productsize'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $status = $_POST['status'];
            $create_at = date('Y-m-d H:i:s');
            $result = $this->orderModel->createOrderModel($id_user, $id_productsize, $name, $address, $phone, $status, $create_at);

            if($result) {
                header('Location: dashboard.php?action=orders');
                exit();
            } else {
                echo "Loi khi them order!";
            }
        }
        $users = $this->orderModel->getUsers();
        $product_sizes = $this->orderModel->getProductSizes();
        include_once __DIR__ . '/../View/Admin/orders/createOrder.php';

    }
}

