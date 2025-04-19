<?php

require_once __DIR__ . '/../Model/CartModel.php';
require_once __DIR__ . '/../Model/SizeModel.php';
require_once __DIR__ . '/../Model/ProductModel.php';

class CartController
{
    private $cartModel;
    private $sizeModel;
    private $productModel;

    public function __construct($db)
    {
        $this->cartModel = new CartModel($db);
        $this->sizeModel = new SizeModel($db);
        $this->productModel = new ProductModel($db);
    }
    public function viewCart()
    {
        if(!isset($_SESSION['user'])) {
            header("Location: ../Auth/404.php");
            exit;
        }

        $id_user = $_SESSION['user']['id'];
        $id_cart = $this->cartModel->getCartByIdUser($id_user)['id'];
        $carts = $this->cartModel->viewCartModel($id_user);

        include_once __DIR__ . '/../View/Client/carts/viewCart.php';
    }
    public function addToCart()
    {
        $id_product = $_GET['id'] ?? null;
        $size_name = $_GET['size'] ?? null;
        $id_user = $_SESSION['user']['id'];
        $id_cart = $this->cartModel->getCartByIdUser($id_user)['id'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $quantity = $_POST['quantity'] ?? 1;

            if (isset($id_product)) {
                $id_size = $this->sizeModel->getSizeId($size_name);
                $price = $this->sizeModel->getProductPrice($id_product, $size_name);

                $existingItem = $this->cartModel->getCartItem($id_cart, $id_product, $id_size);

                if ($existingItem) {
                    $newQuantity = $existingItem['quantity'] + $quantity;

                    $this->cartModel->updateCartItem($existingItem['id'], $newQuantity, $price);
                } else {
                    $this->cartModel->addToCartModel($id_user, $id_cart, $id_product, $id_size, $quantity, $price);
                    
                }

                header("Location: /Du_an_1/View/Client/index.php?action=viewCart");
                exit();
            }
        }
        $product = $this->productModel->getProductById($id_product);
        $products = [];
        if ($product) {
            $product['price'] = $this->sizeModel->getProductPrice($id_product, $size_name);
            $products[] = $product;
        }
        include_once __DIR__ . '/../View/Client/carts/addToCart.php';
    }

    public function removeFromCart()
    {
        $id_cart_item = $_GET['id'] ?? null;

        if ($id_cart_item && is_numeric($id_cart_item)) {
            $this->cartModel->removeCartItem($id_cart_item);
        }

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            echo "deleted";
            exit;
        }

        header("Location: /Du_an_1/View/Client/index.php?action=viewCart");
        exit();
    }
}
