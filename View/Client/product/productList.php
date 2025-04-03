<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card img {
            height: 250px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .size-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-top: 10px;
        }

        .size-button {
            padding: 8px 12px;
            border: 2px solid #007bff;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s, color 0.3s;
            background: #fff;
            color: #007bff;
        }

        .size-button.active {
            background-color: #007bff;
            color: #fff;
        }

        .price {
            font-weight: bold;
            color: #d9534f;
            margin-top: 10px;
        }

        .btn-add-cart {
            background-color: #28a745;
            color: white;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .btn-add-cart:hover {
            background-color: #218838;
        }
    </style>

</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Danh Sách Sản Phẩm</h2>
        <div class="row">
            <?php
            foreach ($products as $product) {
                if (empty($product['product_id']) || empty($product['product_name'])) {
                    continue;
                }
                $firstSize = $product['sizes'][0] ?? null;
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="/Du_an_1/Assets/image/products/<?php echo htmlspecialchars($product['product_image']); ?>" 
                             class="card-img-top" 
                             alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                            <p class="card-text text-muted">Danh mục: <?php echo htmlspecialchars($product['category_name']); ?></p>

                            <?php if (!empty($product['sizes'])): ?>
                                <div class="size-buttons">
                                    <?php foreach ($product['sizes'] as $index => $size): ?>
                                        <button class="size-button <?= $index === 0 ? 'active' : ''; ?>"
                                            data-price="<?= htmlspecialchars($size['size_price']); ?>"
                                            data-product-id="<?= $product['product_id']; ?>"
                                            onclick="selectSize(this, <?= $product['product_id']; ?>)">
                                            <?= htmlspecialchars($size['size_name']); ?>
                                        </button>
                                    <?php endforeach; ?>
                                </div>

                                <p class="price mt-2">Giá:
                                    <span id="price-<?= $product['product_id']; ?>">
                                        <?= number_format($firstSize['size_price'] ?? 0, 0, ',', '.'); ?> VND
                                    </span>
                                </p>
                            <?php else: ?>
                                <p class="text-muted">Không có kích thước nào.</p>
                            <?php endif; ?>

                            <button class="btn btn-add-cart">🛒 Thêm vào giỏ</button>

                            <a href="index.php?action=productDetail&id=<?= $product['product_id']; ?>" 
                               class="btn btn-primary w-100 mt-2">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script>
        function selectSize(button, productId) {
            // Bỏ chọn tất cả các nút kích thước
            const buttons = document.querySelectorAll(`.size-button[data-product-id="${productId}"]`);
            buttons.forEach(btn => {
                btn.classList.remove('active');
            });

            // Chọn nút hiện tại
            button.classList.add('active');

            // Cập nhật giá
            const price = button.getAttribute('data-price');
            document.getElementById(`price-${productId}`).innerText = new Intl.NumberFormat('vi-VN').format(price) + ' VND';
        }

    </script>
</body>
</html>