<?php
require_once __DIR__ . '/../Model/productModel.php';
class ProductController
{
    private $productModel;

    public function __construct($db)
    {
        $this->productModel = new ProductModel($db);
    }

    public function getProductById()
    {
        $id = $_GET['id'];
        $product = $this->productModel->getProductById($id);
    }
    public function listProduct()
    {
        $product = $this->productModel->listProductModel();
        include_once __DIR__ . '/../View/Admin/products/listProduct.php';
    }

    public function listProductClient()
    {
        $product = $this->productModel->listProductModel();
        include_once __DIR__ . '/../View/Client/products/listProduct.php';
    }
    public function createProduct()
    {
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $id_category = $_POST['id_category'];

            if (empty($name)) {
                $errors['name'] = "Tên sản phẩm không được để trống.";
            }

            if (empty($description)) {
                $errors['description'] = "Mô tả không được để trống.";
            }

            if (empty($id_category)) {
                $errors['id_category'] = "Vui lòng chọn danh mục.";
            }

            $size = [];
            foreach ($_POST['size']['size'] as $key => $size_id) {
                $price = $_POST['size']['price'][$key];
                if (!empty($size_id) && is_numeric($price)) {
                    $size[$size_id] = floatval($price);
                } else {
                    $errors['size'] = "Kích cỡ và giá phải hợp lệ (giá là số).";
                }
            }

            $img = "";
            if (!empty($_FILES["img"]["name"])) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!in_array($_FILES["img"]["type"], $allowedTypes)) {
                    $errors['img'] = "Chỉ chấp nhận định dạng ảnh JPG, JPEG, PNG.";
                }

                if ($_FILES["img"]["size"] > 2 * 1024 * 1024) {
                    $errors['img'] = "Ảnh không được vượt quá 2MB.";
                }

                $targetDir = __DIR__ . "/../../Du_an_1/Assets/image/products/";
                $imgPath = $targetDir . basename($_FILES["img"]["name"]);

                if (empty($errors['img']) && move_uploaded_file($_FILES["img"]["tmp_name"], $imgPath)) {
                    $img = basename($_FILES["img"]["name"]);
                } elseif (empty($errors['img'])) {
                    $errors['img'] = "Tải ảnh lên thất bại.";
                }
            }

            if (empty($errors)) {
                $result = $this->productModel->createProductModel($name, $description, $id_category, $img, $size);
                if ($result) {
                    header("Location: dashboard.php?action=product");
                    exit();
                } else {
                    $errors['general'] = "Lỗi khi thêm sản phẩm!";
                }
            }
        }

        $sizes = $this->productModel->getSizes();
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
        include_once __DIR__ . '/../View/Admin/products/detailProduct.php';
    }
}
