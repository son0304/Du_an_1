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

<<<<<<< HEAD
    public function deleteProduct()
    {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "Không tìm thấy id cần xóa";
            return;
        }

        $id = $_GET['id'];

        if ($this->productModel->deleteProductModel($id)) {
            echo "Xóa thành công!";
        } else {
            echo "Lỗi khi xóa sản phẩm!";
        }
        header("Location: dashboard.php?action=product");
        exit();
    }


    public function detailProduct()
    {
=======
    public function deleteProduct() {
        include_once __DIR__ . '/../View/Admin/products/deleteProduct.php';
    }

    public function detailProduct() {
>>>>>>> 294d0ce5651973c99dc7a54f79b0f0f9c3bc8737
        include_once __DIR__ . '/../View/Admin/products/detailProduct.php';
    }

}