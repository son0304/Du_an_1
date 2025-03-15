<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="mt-4">
        <h2 class="text-center">Danh sách sản phẩm</h2>
        <table class="table table-bordered">
            <thead class="table">
                <tr>
                    <th>ID</th>
                    <th>Danh mục</th>
                    <th>Tên sản phẩm</th>
                    <th>Mô tả</th>
                    <th>Ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($product as $product): ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= $product['category_name'] ?></td> 
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['description'] ?></td>
                        <td>
                            <img src="/Assets/<?= $product['img'] ?>" alt="Ảnh sản phẩm" width="80">
                        </td>
                        <td>
                            <a href="dashboard.php?action=editProduct&id=<?= $product['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="dashboard.php?action=deleteProduct&id=<?= $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="dashboard.php?action=createProduct" class="btn btn-primary">Thêm sản phẩm</a>
    </div>
</body>

</html>