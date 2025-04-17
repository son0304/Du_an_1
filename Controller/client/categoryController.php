<?php
require_once __DIR__ . '/../../Model/categoriesModel.php';

class categoryController {
    private $categoriesModel;

    public function __construct($db) {
        $this->categoriesModel = new categoriesModel($db);
    }

    public function listCategoriesWithProducts() {
        $categories = $this->categoriesModel->getCategoriesWithProducts();
        
        // Gửi dữ liệu đến View
        include_once __DIR__ . '/../../View/Client/category/categoryList.php';
    }
}
?>
