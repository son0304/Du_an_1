<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Sản phẩm</h1>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">Danh sách sản phẩm</h6>
            <a href="dashboard.php?action=createProduct" class="btn btn-light">
                <i class="fas fa-plus-circle"></i> Thêm mới
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Tên SP</th>
                            <th>Mô tả</th>
                            <th>Hình ảnh</th>
                            <th>Danh mục</th>
                            <th>Size</th>
                            <th>Giá</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $grouped_products = [];

                        foreach ($product as $p) {
                            $product_id = $p['product_id'];
                            if (!isset($grouped_products[$product_id])) {
                                $grouped_products[$product_id] = [
                                    'info' => $p,
                                    'sizes' => []
                                ];
                            }
                            $grouped_products[$product_id]['sizes'][] = [
                                'size_name' => $p['size_name'],
                                'size_price' => $p['size_price']
                            ];
                        }

                        // Hiển thị danh sách sản phẩm
                        foreach ($grouped_products as $product_id => $data):
                            $product_info = $data['info'];
                            $sizes = $data['sizes'];
                        ?>
                            <tr class="">
                                <td rowspan="<?= count($sizes); ?>"><?= htmlspecialchars($product_info['product_name']); ?></td>
                                <td rowspan="<?= count($sizes); ?>"><?= nl2br(htmlspecialchars($product_info['product_description'])); ?></td>
                                <td class="text-center" rowspan="<?= count($sizes); ?>">
                                    <img src="/Du_an_1/Assets/image/products/<?= htmlspecialchars($product_info['product_image']) ?>" alt="Ảnh sản phẩm" width="70" height="70" style="border-radius: 8px;">
                                </td>
                                <td rowspan="<?= count($sizes); ?>"><?= htmlspecialchars($product_info['category_name']); ?></td>

                                <?php foreach ($sizes as $index => $size): ?>
                                    <?php if ($index > 0): ?>
                                        <tr><?php endif; ?>
                                        <td><?= htmlspecialchars($size['size_name']); ?></td>
                                        <td><?= number_format($size['size_price'], 0, ',', '.'); ?> VND</td>

                                        <?php if ($index === 0): // Chỉ hiển thị nút hành động ở hàng đầu tiên của sản phẩm 
                                        ?>
                                            <!-- <td rowspan="<?= count($sizes); ?>">
                                                <a href="dashboard.php?action=updateProduct&id=<?= $product_info['product_id']; ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Sửa
                                                </a>
                                                <a href="dashboard.php?action=deleteProduct&id=<?= $product_info['product_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">
                                                    <i class="fas fa-trash"></i> Xóa
                                                </a>
                                            </td> -->
                                        <?php endif; ?>

                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
    .table td {
        vertical-align: middle;
    }
</style>
