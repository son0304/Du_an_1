<?php
require_once __DIR__ . '/../Model/productModel.php' ;
class ProductController
{
    private $productModel;

    public function __construct($db) {
        $this->productModel = new ProductModel($db);
    }
    public function listProduct() {
        $product = $this->productModel->listProductModel();
        include_once __DIR__ . '/../View/Admin/products/listProduct.php';
    }
    public function createProduct() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $id_category = $_POST['id_category'];
    
            // Xử lý upload ảnh
            $img = "";
            if (!empty($_FILES["img"]["name"])) {
                $targetDir = "../../" . "/Du_an_1/Assets/image/products/"; // Thư mục chứa ảnh
                $img = $targetDir . basename($_FILES["img"]["name"]);
                move_uploaded_file($_FILES["img"]["tmp_name"], "../../" . $img);
            }
    
            $result = $this->productModel->createProductModel($name, $description, $id_category, $img);
            if ($result) {
                header("Location: dashboard.php?action=product");
                exit();
            } else {
                echo "Lỗi khi thêm sản phẩm!";
            }
        }
    
        $categories = $this->productModel->getCategories();
        include_once __DIR__ . '/../View/Admin/products/createProduct.php';
    }
    

    public function updateProduct() {
        include_once __DIR__ . '/../View/Admin/products/updateProduct.php';
    }

    public function deleteProduct() {
        include_once __DIR__ . '/../View/Admin/products/deleteProduct.php';
    }

    public function detailProduct() {
        include_once __DIR__ . '/../View/Admin/products/detailProduct.php';
    }

}