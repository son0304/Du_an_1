<?php
require_once __DIR__ . '/../../Model/Client/productModel.php';

class ProductController
{
    private $productModel;

    public function __construct($db)
    {
        $this->productModel = new ProductModel($db);
    }

    public function listProduct()
    {
        $products = $this->productModel->listProductModel();
        include_once __DIR__ . '/../../View/Client/product/productList.php';
    }

    public function detailProduct()
    {
        // Lấy ID từ URL (hoặc gán mặc định là 0)
        $productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Lấy dữ liệu từ model
        $productData = $this->productModel->detailProductModel($productId);

        // Kiểm tra nếu không có dữ liệu
        if (empty($productData)) {
            die("Sản phẩm không tồn tại!");
        }

        // Lấy thông tin sản phẩm từ mảng đầu tiên
        $product = [
            "product_id" => $productData[0]["product_id"],
            "product_name" => $productData[0]["product_name"],
            "product_description" => $productData[0]["product_description"],
            "product_image" => $productData[0]["product_image"],
            "category_name" => $productData[0]["category_name"]
        ];

        // Lấy danh sách size từ kết quả truy vấn
        $sizes = array_map(function ($item) {
            return [
                "size_id" => $item["size_id"],
                "size_name" => $item["size_name"],
                "size_price" => $item["size_price"]
            ];
        }, $productData);

        // Gửi dữ liệu đến view
        include_once __DIR__ . '/../../View/Client/product/productDetail.php';
    }
}
