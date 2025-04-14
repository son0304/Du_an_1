<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .product-img {
            width: 100%;
            max-width: 100px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <form action="" method="post">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card p-4">
                        <h4 class="text-center text-primary mb-4">Chi tiết sản phẩm</h4>
                        <?php foreach ($products as $product) : ?>
                            <div class="row align-items-center mb-4 border-bottom pb-3">
                                <div class="col-md-2 col-3 text-center">
                                    <img src="/Du_an_1/Assets/image/products/<?= htmlspecialchars($product['img']) ?>" alt="Ảnh sản phẩm" class="product-img">
                                </div>
                                <div class="col-md-10 col-9">
                                    <h5 class="mb-1 text-dark"><?= htmlspecialchars($product['name']) ?></h5>
                                    <p class="text-muted mb-1">
                                        <?= nl2br(htmlspecialchars($product['description'])) ?>
                                    </p>
                                    <p class="text-danger fw-bold mb-1">
                                        Giá: <span id="price_<?= $product['id'] ?>"><?= number_format($product['price'], 0, ',', '.') ?></span> VND
                                    </p>

                                    <!-- Số lượng -->
                                    <label for="quantity_<?= $product['id'] ?>" class="form-label small">Số lượng:</label>
                                    <input type="number"
                                        name="quantity"
                                        id="quantity_<?= $product['id'] ?>"
                                        class="form-control form-control-sm w-25 quantity-input"
                                        min="1"
                                        value="1"
                                        data-id="<?= $product['id'] ?>"
                                        data-price="<?= $product['price'] ?>">

                                    <!-- Input ẩn gửi totalPrice -->
                                    <input type="hidden"
                                        name="totalPrice"
                                        id="inputTotalPrice_<?= $product['id'] ?>"
                                        value="<?= $product['price'] ?>">

                                    <!-- Hiển thị tạm tính -->
                                    <p class="mt-2 mb-0">
                                        Tạm tính:
                                        <span class="fw-bold text-success" id="totalPrice_<?= $product['id'] ?>">
                                            <?= number_format($product['price'], 0, ',', '.') ?>
                                        </span> VND
                                    </p>
                                </div>
                            </div>
                        <?php endforeach ?>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Tiếp tục</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Script cập nhật giá -->
    <script>
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('input', function() {
                const id = this.dataset.id;
                const price = parseFloat(this.dataset.price);
                const quantity = parseInt(this.value) || 1;
                const totalPrice = price * quantity;

                // Cập nhật hiển thị tạm tính
                document.getElementById(`totalPrice_${id}`).innerText = totalPrice.toLocaleString('vi-VN');

                // Cập nhật giá trị input hidden
                const inputTotal = document.getElementById(`inputTotalPrice_${id}`);
                if (inputTotal) {
                    inputTotal.value = totalPrice;
                }
            });
        });
    </script>
</body>

</html>