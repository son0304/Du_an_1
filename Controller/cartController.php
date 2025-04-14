<?php
require_once __DIR__ . '/../Model/cartModel.php';

class CartController
{
    private $cartModel;

    public function __construct($db)
    {
        $this->cartModel = new CartModel($db);
    }
    public function listCart()
    {
        $cart = $this->cartModel->listCartModel();
        include_once __DIR__ . '/../View/Client/cart.php';
    }
}
