<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
body {
    background-color: #f0f4f8;
    font-family: 'Roboto', sans-serif;
}

.card {
    border-radius: 15px;
    border: 2px solid #0d6efd;
    background-color: #ffffff;
    overflow: hidden;
    transition: transform 0.3s ease-in-out;
}

.card:hover {
    transform: scale(1.02);
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
}

.card img {
    height: 200px;
    object-fit: cover;
    border-radius: 10px 10px 0 0;
}

.product-title {
    font-size: 20px;
    font-weight: 600;
    color: #0d1a26;
}

.product-description {
    font-size: 15px;
    color: #4a4a4a;
    margin-top: 5px;
}

.delivery-time {
    background: #ffffff;
    border: 1px dashed #0d6efd;
    padding: 8px;
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    color: #0d6efd;
    border-radius: 8px;
    margin: 10px 0;
}

.price {
    font-weight: bold;
    font-size: 17px;
    color: #dc3545; /* đỏ tươi */
}

.old-price {
    text-decoration: line-through;
    color: #888;
    font-size: 13px;
    margin-right: 5px;
}

.size-buttons {
    display: flex;
    justify-content: flex-start;
    gap: 10px;
    flex-wrap: wrap;
    margin: 10px 0;
}

.size-button {
    padding: 6px 12px;
    border: 2px solid #0d6efd;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.3s;
    background: white;
    color: #0d6efd;
}

.size-button.active {
    background: #0d6efd;
    color: white;
}

.btn-container {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.btn-buy-now {
    flex: 1;
    background: #0d6efd;
    color: white;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    font-weight: bold;
    transition: background 0.3s;
    border: none;
    font-size: 15px;
    align-self: stretch;
}

.btn-buy-now:hover {
    background: #0b5ed7;
}

.btn-cart {
    background: white;
    border: 2px solid #0d6efd;
    border-radius: 5px;
    padding: 10px 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s;
    font-size: 18px;
    color: #0d6efd;
    align-self: stretch;
}

.btn-cart:hover {
    background: #0d6efd;
    color: white;
}

    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <?php foreach ($products as $product): 
            if (empty($product['product_id']) || empty($product['product_name'])) continue;
            $firstSize = $product['sizes'][0] ?? null;
        ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">    
                    <img src="/Du_an_1/Assets/image/products/<?php echo htmlspecialchars($product['product_image']); ?>" 
                         class="card-img-top" 
                         alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                    <div class="card-body">
                        <h5 class="product-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                        <p class="product-description">
                            mô tả :
                            <?php echo htmlspecialchars($product['product_description']); ?>
                        </p>
                        <?php if (!empty($product['sizes'])): ?>
                            Chọn Size :
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
                        <?php else: ?>
                            <p class="text-muted">Không có kích thước nào.</p>
                        <?php endif; ?>

                        <p class="price">
                            Giá:
                            <?php if (!empty($firstSize['original_price'])): ?>
                                <span class="old-price"><?= number_format($firstSize['original_price'], 0, ',', '.'); ?> VND</span>
                            <?php endif; ?>
                            <span id="price-<?= $product['product_id']; ?>">
                                <?= number_format($firstSize['size_price'] ?? 0, 0, ',', '.'); ?> VND
                            </span>
                        </p>



                        <div class="btn-container">
                            <button class="btn-buy-now">Đặt ngay</button>
                            <button class="btn-cart">🛒</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    function selectSize(button, productId) {
        const buttons = document.querySelectorAll(`.size-button[data-product-id="${productId}"]`);
        buttons.forEach(btn => btn.classList.remove('active'));

        button.classList.add('active');

        const price = button.getAttribute('data-price');
        document.getElementById(`price-${productId}`).innerText = new Intl.NumberFormat('vi-VN').format(price) + ' VND';
    }
</script>

</body>
</html>
