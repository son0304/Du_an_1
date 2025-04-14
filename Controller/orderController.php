<?php

require_once __DIR__ . '/../Model/orderModel.php';
require_once __DIR__ . '/../Model/sizeModel.php';


class OrderController
{
    private $orderModel;
    private $productModel;
    private $sizeModel;

    public function __construct($db)
    {
        $this->orderModel = new OrderModel($db);
        $this->productModel = new ProductModel($db);
        $this->sizeModel = new SizeModel($db);
    }

    public function listOrder() {
        $order = $this->orderModel->listOrderModel();
        include_once __DIR__ . '/../View/Admin/orders/listOrder.php';
    }
    public function createOrder()
    {
        $id_product = $_GET['id'] ?? null;
        $size_name = $_GET['size'] ?? null;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_user = $_SESSION['user']['id'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $status = STATUS_UNCOMFIRMED;
            $created_at = date('Y-m-d H:i:s');


            if (isset($id_product)) {
                $cart_item = [];
                $cart_item[] = [
                    'id_product' => $id_product,
                    'quantity' => (int)$_POST['quantity'] ?? 2,
                    'id_size' => $this->sizeModel->getSizeId($size_name),
                    'price' => $this->sizeModel->getProductPrice($id_product, $size_name),

                ];
            } else {
                
            }
            $total_price = 0;
            foreach ($cart_item as $item) {
                $total_price += $item['price'] * $item['quantity'];
            }



            $id_order = $this->orderModel->createOrderModel($id_user, $name, $phone, $address, $total_price, $cart_item, $status, $created_at);
           
        }

        $product = $this->productModel->getProductById($id_product);
        $products = [];
        if ($product) {
            $products[] = $product;
        }
        include_once __DIR__ . '/../View/Client/orders/order.php';
    }
}