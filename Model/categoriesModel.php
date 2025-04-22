<?php
require_once '../../Config/config.php' ;
class categoriesModel{
    public $conn;
    public function __construct($db){
        $this->conn = $db;
    }
    public function listCategories(){
        $sql = "SELECT * FROM categories";
        $result = $this->conn->query($sql);
        return $result;
    }
    public function createCategoryModel($name){
        $sql = "INSERT INTO categories (name) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        return $stmt->execute();
    }
    public function getCategoriesWithProducts() {
        $sql = "SELECT 
                    c.id AS category_id, 
                    c.name AS category_name, 
                    p.id AS product_id, 
                    p.name AS product_name, 
                    p.description AS product_description, 
                    p.img AS product_image, 
                    s.id AS size_id, 
                    s.name AS size_name, 
                    ps.price AS size_price
                FROM categories c
                LEFT JOIN products p ON p.id_category = c.id
                LEFT JOIN product_sizes ps ON ps.id_product = p.id
                LEFT JOIN sizes s ON ps.id_size = s.id
                ORDER BY c.id, p.id, s.id;";
    
        $result = $this->conn->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
    
        // Tạo danh sách danh mục với danh sách sản phẩm lồng bên trong
        $categories = [];
        foreach ($data as $row) {
            $categoryId = $row['category_id'];
            $productId = $row['product_id'];
    
            // Nếu danh mục chưa tồn tại trong mảng, thêm vào
            if (!isset($categories[$categoryId])) {
                $categories[$categoryId] = [
                    'category_id' => $row['category_id'],
                    'category_name' => $row['category_name'],
                    'products' => []
                ];
            }
    
            // Nếu sản phẩm chưa tồn tại trong danh mục, thêm vào
            if (!isset($categories[$categoryId]['products'][$productId])) {
                $categories[$categoryId]['products'][$productId] = [
                    'product_id' => $row['product_id'],
                    'product_name' => $row['product_name'],
                    'product_description' => $row['product_description'],
                    'product_image' => $row['product_image'],
                    'sizes' => [] // Chứa danh sách size của sản phẩm
                ];
            }
    
            // Nếu có size, thêm size vào danh sách
            if ($row['size_id']) {
                $categories[$categoryId]['products'][$productId]['sizes'][] = [
                    'size_id' => $row['size_id'],
                    'size_name' => $row['size_name'],
                    'size_price' => $row['size_price']
                ];
            }
        }
    
        // Chuyển từ mảng kết hợp sang mảng số để dễ xử lý trong view
        foreach ($categories as &$category) {
            $category['products'] = array_values($category['products']);
        }
    
        return array_values($categories);
    }
    
    
}


?>