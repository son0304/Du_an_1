<?php
require_once __DIR__ . '/../Model/productModel.php';
class ProductController
{
    private $productModel;

    public function __construct($db)
    {
        $this->productModel = new ProductModel($db);
    }
    public function listProduct()
    {
        $product = $this->productModel->listProductModel();
        include_once __DIR__ . '/../View/Admin/products/listProduct.php';
    }
    public function createProduct()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $id_category = $_POST['id_category'];

            $size = [];
            foreach ($_POST['size']['size'] as $key => $size_name) {
                $price = $_POST['size']['price'][$key];
                if (!empty($size_name) && is_numeric($price)) {
                    $size[$size_name] = floatval($price);
                }
            }
            $img = "";
            if (!empty($_FILES["img"]["name"])) {
                $targetDir = __DIR__ . "/../../Du_an_1/Assets/image/products/";
                $imgPath = $targetDir . basename($_FILES["img"]["name"]);

                if (move_uploaded_file($_FILES["img"]["tmp_name"], $imgPath)) {
                    $img = basename($_FILES["img"]["name"]);
                } else {
                    $img = "";
                }
            }

            $result = $this->productModel->createProductModel($name, $description, $id_category, $img, $size);
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


    public function updateProduct()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            $name = $_POST['name'];
            $description = $_POST['description'];
            $id_category = $_POST['id_category'];
            $size = $_POST['size'] ?? [];
            $img = null;

            if (!empty($_FILES["img"]["name"])) {
                $targetDir = __DIR__ . "/../../Du_an_1/Assets/image/products/";
                $imgPath = $targetDir . basename($_FILES["img"]["name"]);

                if (move_uploaded_file($_FILES["img"]["tmp_name"], $imgPath)) {
                    $img = basename($_FILES["img"]["name"]);
                }
            }

            $result = $this->productModel->updateProductModel($id, $name, $description, $id_category, $img, $size);

            if ($result) {
                header("Location: dashboard.php?action=product");
                exit();
            } else {
                $error = "Cập nhật sản phẩm thất bại!";
            }
        }
        $categories = $this->productModel->getCategories();


        include_once __DIR__ . '/../View/Admin/products/updateProduct.php';
    }


    public function deleteProduct()
    {
        if (!isset($_GET['id'])|| empty($_GET['id'])) {
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
        include_once __DIR__ . '/../View/Admin/products/detailProduct.php';
    }
}
