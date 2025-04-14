<?php

require_once __DIR__ . '/../Model/orderModel.php';
require_once __DIR__ . '/../Model/productModel.php';
require_once __DIR__ . '/../Model/sizeModel.php';
require_once __DIR__ . '/../Model/cartModel.php';

class OrderController
{
    private $orderModel;
    private $productModel;
    private $sizeModel;
    private $cartModel;


    public function __construct($db)
    {
        $this->orderModel = new OrderModel($db);
        $this->productModel = new ProductModel($db);
        $this->sizeModel = new SizeModel($db);
        $this->cartModel = new CartModel($db);
    }



    function listOrders() {
        $orders = $this->orderModel->listOrderModel();

        include_once __DIR__ . '/../View/Admin/orders/listOrder.php';
    }

    function detailOrderAdmin() {
        $id = $_GET['id'] ?? null;
        $orderDetail = $this->orderModel->getOrderById($id);

        include_once __DIR__ . '/../View/Admin/orders/detailOrder.php';
    }







//=====================client=====================
    public function listOrdersByUser()
    {
        $id_user = $_SESSION['user']['id'] ?? null; 
        if (!$id_user) {
            echo "Vui lòng đăng nhập.";
            return;
        }

        $orders = $this->orderModel->getOrdersByUserId($id_user);
        include_once __DIR__ . '/../View/Client/order/listOrder.php';
    }



    // Hiển thị chi tiết đơn hàng của khách hàng
    public function detailOrderClient()
    {
        $id_order = $_GET['id'] ?? null;
        $orderDetail = $this->orderModel->getOrderById($id_order);
        include_once __DIR__ . '/../View/Client/order/orderDetail.php';
    }

    // Tạo đơn hàng mới
    public function createOrder()
    {
        // Lấy thông tin sản phẩm và kích thước
        $id_product = $_GET['id'] ?? null;
        $size_name = $_GET['size'] ?? null;
        $id_Cart = $_GET['id_Cart'] ?? null;
        $product = $this->productModel->getProductById($id_product);
        $price = $this->sizeModel->getProductPrice($id_product, $size_name);
        $products = [];

        if ($product) {
            $products[] = $product;
        }

        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Lấy thông tin người dùng và đơn hàng từ POST
                $id_user = $_SESSION['user']['id'];
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $status = "Chờ xác nhận";
                $created_at = date('Y-m-d H:i:s');
                $received_date = $_POST['received_date'] ?? null;
                $received_time = $_POST['received_time'] ?? null;
                $payment = $_POST['payment'] ?? null;

                // Xử lý cart_item nếu có sản phẩm
                if (isset($id_product)) {
                    $cart_item = [];
                    $cart_item[] = [
                        'id_product' => $id_product,
                        'quantity' => (int) ($_POST['quantity'] ?? 1),
                        'id_size' => $this->sizeModel->getSizeId($size_name),
                        'price' => $price,
                    ];
                } else {
                    // $cart_item = $this->cartModel->getCartItemById($id_Cart);
                    // var_dump($cart_item);
                }

                // Tính tổng giá trị đơn hàng
                $total_price = 0;
                foreach ($cart_item as $item) {
                    $total_price += $item['price'] * $item['quantity'];
                }

                // Tạo đơn hàng mới
                $id_order = $this->orderModel->createOrderModel($id_user, $name, $phone, $address, $total_price, $cart_item, $status, $created_at, $received_date, $payment, $received_time);
                if ($id_order) {
                    echo "
                    <script>
                    alert('Đặt hàng thành công');
                    window.location.href='?action=detailOrder&id=$id_order';
                    </script>";
                    exit;
                } else {
                    echo "<script>alert('Đã xảy ra lỗi khi tạo đơn hàng.');</script>";
                }
            }
        } catch (Exception $e) {
            echo "<script>alert('Đã xảy ra lỗi trong quá trình đặt hàng. Vui lòng thử lại.');</script>";
        }

        include_once __DIR__ . '/../View/Client/order/order.php';
    }
}