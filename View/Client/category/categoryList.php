<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Roboto', sans-serif;
        }

        .category-container {
            margin-bottom: 40px;
        }

        .card {
            border-radius: 15px;
            border: none;
            background-color: white;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.1);
        }

        .card img {
            height: 200px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        .product-title {
            font-size: 20px;
            font-weight: 600;
            color: #1976d2;
        }

        .product-description {
            font-size: 15px;
            color: #666;
            margin-top: 5px;
        }

        .size-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin: 10px 0;
        }

        .size-button {
            padding: 6px 12px;
            border: 2px solid #1976d2;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            background: white;
            color: #1976d2;
        }

        .size-button.active {
            background: #1976d2;
            color: white;
        }

        .price {
            font-weight: bold;
            font-size: 17px;
            color: #d32f2f;
        }

        .btn-container {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .btn-buy-now {
            flex: 1;
            background: #1976d2;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            border: none;
            font-size: 15px;
        }

        .btn-buy-now:hover {
            background: #0d47a1;
        }

        .btn-cart {
            width: 44px;
            height: 44px;
            background: white;
            border: 2px solid #1976d2;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #1976d2;
        }

        .btn-cart:hover {
            background: #1976d2;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-5 text-center text-primary">Danh sách danh mục & sản phẩm</h2>
        <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $category): ?>
                <?php if (!empty($category['category_name'])): ?>
                    <div class="category-container">
                        <h3 class="mb-4 text-primary">📌 <?= htmlspecialchars($category['category_name']); ?></h3>
                        <div class="row">
                            <?php if (!empty($category['products'])): ?>
                                <?php foreach ($category['products'] as $product): ?>
                                    <?php
                                    if (empty($product['product_id']) || empty($product['product_name'])) continue;
                                    $firstSize = $product['sizes'][0] ?? null;
                                    ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card shadow-sm">
                                            <img src="/Du_an_1/Assets/image/products/<?= htmlspecialchars($product['product_image'] ?? 'default.jpg'); ?>" class="card-img-top" alt="<?= htmlspecialchars($product['product_name']); ?>">
                                            <div class="card-body">
                                                <h5 class="product-title"><?= htmlspecialchars($product['product_name']); ?></h5>
                                                <p class="product-description">Mô tả: <?= htmlspecialchars($product['product_description'] ?? ''); ?></p>

                                                <?php if (!empty($product['sizes'])): ?>
                                                    Chọn Size:
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

                                                    <p class="price mb-2">
                                                        Giá:
                                                        <span id="price-<?= $product['product_id']; ?>">
                                                            <?= number_format($firstSize['size_price'] ?? 0, 0, ',', '.'); ?> VND
                                                        </span>
                                                    </p>
                                                <?php else: ?>
                                                    <p class="text-muted">Không có kích thước nào.</p>
                                                <?php endif; ?>

                                                <div class="btn-container">
                                                    <button class="btn-buy-now" onclick="window.location.href='index.php?action=productDetail&id=<?= $product['product_id']; ?>&size=<?= $firstSize['size_name'] ?? '' ?>&price=<?= $firstSize['size_price'] ?? 0 ?>'">Đặt ngay</button>
                                                    <button class="btn-cart" onclick="addToCart(<?= $product['product_id']; ?>)">🛒</button>
                                                </div>
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

    <script>
        function selectSize(button, productId) {
            const buttons = document.querySelectorAll(`.size-button[data-product-id="${productId}"]`);
            buttons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const price = button.getAttribute('data-price');
            document.getElementById(`price-${productId}`).innerText = new Intl.NumberFormat('vi-VN').format(price) + ' VND';
        }

        function addToCart(productId) {
            const activeSize = document.querySelector(`.size-button[data-product-id="${productId}"].active`);
            if (!activeSize) {
                alert("Vui lòng chọn kích thước!");
                return;
            }
            const sizeName = activeSize.innerText;
            const price = activeSize.getAttribute('data-price');
            alert(`🛒 Đã thêm vào giỏ: ${sizeName} - ${new Intl.NumberFormat('vi-VN').format(price)} VND`);
        }
    </script>
</body>

</html>
