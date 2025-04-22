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

    // Constructor: Khởi tạo các model cần thiết
    public function __construct($db)
    {
        $this->orderModel = new OrderModel($db);
        $this->productModel = new ProductModel($db);
        $this->sizeModel = new SizeModel($db);
        $this->cartModel = new CartModel($db);
    }

    //===================== Admin Functions =====================

    // Liệt kê tất cả các đơn hàng (Admin)
    function listOrders()
    {
        $search = $_POST['search'] ?? null;
        $status = $_POST['status'] ?? null;

        $searchFormatted = '%' . ($search) . '%';

        if (!empty($search) || !empty($status)) {
            $orders = $this->orderModel->searchOrder($searchFormatted, $status);
        } else {
            $orders = $this->orderModel->listOrderModel();
        }

        include_once __DIR__ . '/../View/Admin/orders/listOrder.php';
    }

    // Chi tiết đơn hàng (Admin)
    function detailOrderAdmin()
    {
        $id_order = $_GET['id'] ?? null;

        if (!$id_order) {
            $_SESSION['message'] = "Không tìm thấy đơn hàng.";
            $_SESSION['type'] = 'danger';
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_status'])) {
            $newStatus = $_POST['new_status'];
            $this->orderModel->updateStatusOrderModel($id_order, $newStatus);

            $_SESSION['message'] = "Cập nhật trạng thái đơn hàng thành công.";
            $_SESSION['type'] = 'success';

            header("Location: dashboard.php?action=detailOrder&id=" . $id_order);
            exit;
        }

        $orderDetail = $this->orderModel->getOrderById($id_order);
        include_once __DIR__ . '/../View/Admin/orders/detailOrder.php';
    }

    //===================== Client Functions =====================

    // Liệt kê các đơn hàng của người dùng
    public function listOrdersByUser()
    {
        $id_user = $_SESSION['user']['id'] ?? null;
        if (!$id_user) {
            echo "Vui lòng đăng nhập.";
            return;
        }

        $search = $_POST['search'] ?? null;
        $status = $_POST['status'] ?? null;

        $searchFormatted = '%' . ($search) . '%';

        if (!empty($search) || !empty($status)) {
            $orders = $this->orderModel->searchOrderByUser($id_user, $searchFormatted, $status);
        } else {
            $orders = $this->orderModel->getOrdersByUserId($id_user);
        }

        include_once __DIR__ . '/../View/Client/order/listOrder.php';
    }



    public function detailOrderClient()
    {
        $id_order = $_GET['id'] ?? null;
        $orderDetail = $this->orderModel->getOrderById($id_order);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_order'])) {
            $id_order = $_POST['id_order'] ?? null;
            $status = $_POST['status'] ?? null;
            if ($id_order && $status) {
                $this->orderModel->updateStatusOrderModel($id_order, $status);
                $_SESSION['message'] = "Cập nhật trạng thái thành công";
                $_SESSION['type'] = 'success';
            }
        }

        // Cập nhật thông tin đơn hàng
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_order'])) {
            $id_order = $_POST['id_order'] ?? null;
            $name = $_POST['name'] ?? null;
            $phone = $_POST['phone'] ?? null;
            $address = $_POST['address'] ?? null;
            $date = $_POST['received_date'] ?? null;
            $time = $_POST['received_time'] ?? null;
            $payment = $_POST['payment'] ?? null;

            if ($id_order && $name && $phone && $address && $date && $time) {
                $this->orderModel->updateOrderModel($id_order, $name, $phone, $address, $date, $time, $payment);
                $_SESSION['message'] = "Cập nhật đơn hàng!";
                $_SESSION['type'] = 'success';
                header("Location: index.php?action=detailOrder&id=" . $id_order);
                exit;
            }
        }

        include_once __DIR__ . '/../View/Client/order/orderDetail.php';
    }

    //===================== Order Creation =====================

    // Tạo đơn hàng mới
    public function createOrder()
    {
        $id_product = $_GET['id'] ?? null;
        $size_name = $_GET['size'] ?? null;
        $id_cart = $_GET['id_cart'] ?? null;
        $product = $this->productModel->getProductById($id_product);

        $cart_items = [];
        if ($id_cart) {
            $cart_items = $this->cartModel->getCartItemByIdCart($id_cart);
        }

        $products = [];
        if ($product && $id_product && $size_name) {
            $id_size = $this->sizeModel->getSizeId($size_name);
            $price = $this->sizeModel->getProductPrice($id_product, $size_name);

            $product['quantity'] = (int)($_POST['quantity'] ?? 1);
            $product['price'] = $price;
            $product['id_size'] = $id_size;

            $products[] = $product;
        } else {
            foreach ($cart_items as $item) {
                $product_info = $this->productModel->getProductByCart($item['id_product']);
                if (is_array($product_info) && count($product_info) > 0) {
                    $cart_product = $product_info[0];
                    $cart_product['quantity'] = $item['quantity'];
                    $cart_product['price'] = $item['price'];
                    $cart_product['id_size'] = $item['id_size'];
                    $products[] = $cart_product;
                }
            }
        }

        // Xử lý việc tạo đơn hàng
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id_user = $_SESSION['user']['id'];
                $name = trim($_POST['name']);
                $phone = trim($_POST['phone']);
                $address = trim($_POST['address']);
                $received_date = $_POST['received_date'] ?? null;
                $received_time = $_POST['received_time'] ?? null;
                $payment = $_POST['payment'] ?? null;

                if (empty($name) || empty($phone) || empty($address)) {
                    $_SESSION['message'] = "Vui lòng điền đầy đủ thông tin";
                    $_SESSION['type'] = 'error';
                    return;
                }

                $status = "chờ xác nhận";
                $created_at = date('Y-m-d H:i:s');
                $cart_item = [];

                if ($id_product) {
                    $quantity = (int)($_POST['quantity'] ?? 1);
                    $id_size = $this->sizeModel->getSizeId($size_name);
                    if (!$price || !$id_size) {
                        $_SESSION['message'] = "Không lấy được thông tin sản phẩm";
                        $_SESSION['type'] = 'error';
                        return;
                    }
                    $cart_item[] = [
                        'id_product' => $id_product,
                        'quantity' => $quantity,
                        'id_size' => $id_size,
                        'price' => $price,
                    ];
                } else {
                    $cart_item = $cart_items;
                }

                // Tính tổng giá trị đơn hàng
                $total_price = 0;
                foreach ($cart_item as $item) {
                    $total_price += $item['price'] * $item['quantity'];
                }

                $id_order = $this->orderModel->createOrderModel($id_user, $name, $phone, $address, $total_price, $cart_item, $status, $created_at, $received_date, $payment, $received_time);

                // Xử lý kết quả
                if ($id_order) {
                    if ($id_cart) {
                        $this->cartModel->clearCart($id_cart);
                    }

                    $_SESSION['message'] = "Thêm mới đơn hàng thành công";
                    $_SESSION['type'] = 'success';
                    header("Location: index.php?action=detailOrder&id=" . $id_order);
                    exit;
                } else {
                    $_SESSION['message'] = "Thêm mới đơn hàng thất bại";
                    $_SESSION['type'] = 'error';
                }
            }
        } catch (Exception $e) {
            $_SESSION['message'] = "Thêm mới đơn hàng thất bại";
            $_SESSION['type'] = 'error';
        }

        include_once __DIR__ . '/../View/Client/order/order.php';
    }
}
