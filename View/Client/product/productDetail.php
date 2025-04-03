<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <meta name="description" content="Trang chi tiết sản phẩm - Xem thông tin, hình ảnh, giá cả và chọn size sản phẩm dễ dàng.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .product-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .product-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .size-buttons { display: flex; gap: 10px; margin-top: 10px; }
        .size-button {
            padding: 8px 12px;
            border: 2px solid #007bff;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            background: #fff;
            color: #007bff;
            transition: 0.3s;
        }
        .size-button.active { background-color: #007bff; color: #fff; }
        .price { font-size: 1.8rem; font-weight: bold; color: #d9534f; margin-top: 10px; }
        .btn-add-cart {
            margin-top: 20px;
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            border: none;
            padding: 12px 20px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #fff;
            border-radius: 8px;
            width: 100%;
            transition: 0.3s;
        }
        .btn-add-cart:hover { background: linear-gradient(to right, #ff4b2b, #ff416c); transform: scale(1.05); }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="product-container">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="/Du_an_1/Assets/image/products/<?php echo htmlspecialchars($product['product_image']); ?>" 
                                 class="product-image" 
                                 alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                        </div>
                        <div class="col-md-6">
                            <h2 class="product-title">Chi tiết sản phẩm</h2>
                            <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                            <p class="category">Danh mục: <strong><?php echo htmlspecialchars($product['category_name']); ?></strong></p>
                            <p class="description">Mô tả: <?php echo nl2br(htmlspecialchars($product['product_description'])); ?></p>
                            
                            <label class="form-label">Chọn size:</label>
                            <div class="size-buttons">
                                <?php foreach ($sizes as $index => $size) { ?>
                                    <button class="size-button <?= $index === 0 ? 'active' : ''; ?>"
                                            data-price="<?= htmlspecialchars($size['size_price']); ?>"
                                            onclick="selectSize(this)">
                                        <?= htmlspecialchars($size['size_name']); ?>
                                    </button>
                                <?php } ?>
                            </div>
                            <p class="price mt-3">Giá: <span id="price"><?php echo number_format($sizes[0]['size_price'], 0, ',', '.'); ?> VNĐ</span></p>
                            <button class="btn btn-add-cart" >🛒 Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectSize(button) {
            document.querySelectorAll('.size-button').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            document.getElementById("price").innerText = new Intl.NumberFormat('vi-VN').format(button.getAttribute("data-price")) + ' VNĐ';
        }

    </script>
</body>
</html>
