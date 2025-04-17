<?php

require_once __DIR__ . '/../Config/config.php';

class CartModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy danh sách sản phẩm trong giỏ hàng theo user
    public function viewCartModel($id_user)
    {
        // Lấy giỏ hàng của user
        $sql = 'SELECT id FROM carts WHERE id_user = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            return [];
        }

        $id_cart = $row['id'];

        // Lấy các sản phẩm trong giỏ hàng
        $sql = 'SELECT 
                    ci.id, 
                    ci.id_product, 
                    ci.id_size, 
                    ci.quantity, 
                    ci.totalPrice,
                    p.name AS product_name, 
                    p.img AS product_image,
                    s.name AS size_name,
                    ps.price AS size_price
                FROM cart_items ci
                LEFT JOIN products p ON ci.id_product = p.id
                LEFT JOIN product_sizes ps ON ps.id_size = ci.id_size AND ps.id_product = ci.id_product
                LEFT JOIN sizes s ON ci.id_size = s.id
                WHERE ci.id_cart = ?';

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id_cart);
        $stmt->execute();
        $result = $stmt->get_result();

        $cart_items = [];

        while ($item = $result->fetch_assoc()) {
            $cart_items[] = [
                'id'            => $item['id'],
                'product_name'  => $item['product_name'],
                'product_image' => $item['product_image'],
                'size_name'     => $item['size_name'],
                'size_price'    => $item['size_price'],
                'quantity'      => $item['quantity'],
                'totalPrice'    => $item['totalPrice']
            ];
        }

        return $cart_items;
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCartModel($id_user, $id_cart, $id_product, $id_size, $quantity, $totalPrice)
    {
        $sql_insert = "INSERT INTO cart_items (id_cart, id_product, id_size, quantity, totalPrice)
                       VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql_insert);
        $stmt->bind_param("iiiid", $id_cart, $id_product, $id_size, $quantity, $totalPrice);
        return $stmt->execute();
    }

    // Lấy giỏ hàng theo id_user
    public function getCartByIdUser($id_user)
    {
        $sql = 'SELECT * FROM carts WHERE id_user = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getCartItem($id_cart, $id_product, $id_size)
    {
        $sql = "SELECT * FROM cart_items WHERE id_cart = ? AND id_product = ? AND id_size = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $id_cart, $id_product, $id_size);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // ✅ Cập nhật lại số lượng và tổng giá của item trong giỏ
    public function updateCartItem($id_cart_item, $quantity, $totalPrice)
    {
        $sql = "UPDATE cart_items SET quantity = ?, totalPrice = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("idi", $quantity, $totalPrice, $id_cart_item);
        return $stmt->execute();
    }

    // ✅ Xóa một sản phẩm khỏi giỏ hàng
    public function removeCartItem($id_cart_item)
    {
        $sql = "DELETE FROM cart_items WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_cart_item);
        return $stmt->execute();
    }

    public function countCartItems($id_cart)
    {
        $sql = "SELECT COUNT(DISTINCT id_product) as unique_products FROM cart_items WHERE id_cart = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_cart);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['unique_products'] ?? 0;
    }
}
