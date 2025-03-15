<?php
class UserController
{
    public function __construct($db) {
      
    }
    public function listProduct() {
        include_once '../View/Admin/products/listProduct.php';
    }
    public function createProduct() {
        include_once '../View/Admin/products/createProduct.php';
    }

    public function updateProduct() {
        include_once '../View/Admin/products/updateProduct.php';
    }

    public function deleteProduct() {
        include_once '../View/Admin/products/deleteProduct.php';
    }

    public function detailProduct() {
        include_once '../View/Admin/products/detailProduct.php';
    }

}