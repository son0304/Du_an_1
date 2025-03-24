<?php
require_once __DIR__ . '/../Model/categoriesModel.php' ;

class categoriesController{ 
private $categoriesModel;
    public function __construct($db) {
        $this->categoriesModel = new categoriesModel($db);
    }

    public function listCategory() {
        $categories = $this->categoriesModel->listCategories();            
        include_once __DIR__ . '/../View/Admin/categories/listcategorie.php';    }
    public function createCategory() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $result = $this->categoriesModel->createCategoryModel($name);
            if ($result) {
                header("Location: dashboard.php?action=categories");
                exit();
            } else {
                echo "Lỗi khi thêm danh mục sản phẩm!";
            }
        }
        include_once __DIR__ . '/../View/Admin/categories/createCategory.php';
    }   
    public function updateCategory() {
        include_once __DIR__ . '/../View/Admin/categories/updateCategory.php';
    }
    public  function deleteCategory() {
        include_once __DIR__ . '/../View/Admin/categories/deleteCategory.php';
    }
}

?>