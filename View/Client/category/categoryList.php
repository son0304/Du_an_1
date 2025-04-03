<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục sản phẩm</title>
    <meta name="description" content="Trang danh mục sản phẩm - Xem danh sách danh mục và các sản phẩm kèm giá cả, kích thước.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .category-container {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
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
        <h2 class="mb-4 text-center">Danh sách danh mục & sản phẩm</h2>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <?php if (!empty($category['category_name'])): ?>
                            <div class="category-container">
                                <h3 class="text-primary">📌 <?= htmlspecialchars($category['category_name'] ?? 'Không xác định'); ?></h3>
                                <div class="row">
                                    <?php if (!empty($category['products'])): ?>
                                        <?php foreach ($category['products'] as $product): ?>
                                            <?php
                                            if (empty($product['product_id']) || empty($product['product_name'])) {
                                                continue; // Bỏ qua sản phẩm không hợp lệ
                                            }
                                            $firstSize = $product['sizes'][0] ?? null;
                                            ?>
                                            <div class="col-md-4 mb-4">
                                                <div class="card shadow-sm">
                                                    <img src="/Du_an_1/Assets/image/products/<?= htmlspecialchars($product['product_image'] ?? 'default.jpg'); ?>"
                                                        class="card-img-top"
                                                        alt="<?= htmlspecialchars($product['product_name']); ?>">
                                                    <div class="card-body text-center">
                                                        <h5 class="card-title">🔹 <?= htmlspecialchars($product['product_name']); ?></h5>
                                                        
                                                        <?php if (!empty($product['sizes'])): ?>
                                                            <div class="size-buttons">
                                                                <?php foreach ($product['sizes'] as $index => $size): ?>
                                                                    <button class="size-button <?= $index === 0 ? 'active' : ''; ?>"
                                                                        data-price="<?= htmlspecialchars($size['size_price']); ?>"
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

                                                        <button class="btn btn-add-cart" onclick="addToCart(<?= $product['product_id']; ?>)">🛒 Thêm vào giỏ</button>
                                                        
                                                        <a href="index.php?action=productDetail&id=<?= $product['product_id']; ?>"
                                                            class="btn btn-primary w-100 mt-2">Xem chi tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="text-muted">Không có sản phẩm nào.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-muted">Không có danh mục nào.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function selectSize(button, productId) {
            // Xóa class 'active' khỏi tất cả các nút trong cùng một nhóm
            let buttons = button.parentElement.querySelectorAll('.size-button');
            buttons.forEach(btn => btn.classList.remove('active'));

            // Thêm class 'active' vào nút được chọn
            button.classList.add('active');

            // Cập nhật giá
            let priceDisplay = document.getElementById(`price-${productId}`);
            priceDisplay.innerText = new Intl.NumberFormat('vi-VN').format(button.dataset.price) + ' VND';
        }

        function addToCart(productId) {
            let activeSize = document.querySelector(`.card-body .size-button.active`);
            if (!activeSize) {
                alert("Vui lòng chọn kích thước!");
                return;
            }
            let sizeName = activeSize.innerText;
            let price = activeSize.dataset.price;

            alert(`🛒 Đã thêm vào giỏ: ${sizeName} - ${new Intl.NumberFormat('vi-VN').format(price)} VND`);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
