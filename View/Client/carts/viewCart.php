<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .product-info img {
            width: 80px;
            height: auto;
            margin-right: 15px;
        }

        .product-info {
            display: flex;
            align-items: center;
        }

        .product-name {
            font-weight: 500;
        }

        .product-size {
            font-size: 0.9rem;
            color: #666;
        }

        .cart-row {
            position: relative;
            padding-bottom: 30px;
            border-bottom: 1px solid #dee2e6;
        }

        .btn-delete-item {
            position: absolute;
            right: 0;
            bottom: 0;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4 text-center text-primary">🛒 Giỏ hàng của <?= $_SESSION['user']['name'] ?? 'Người dùng' ?></h2>

        <?php if (!empty($carts)): ?>
            <h5 class="text-muted mb-4 text-center" id="cart-count-text">
                🧾 Bạn có <?= count($carts) ?> sản phẩm trong giỏ hàng.
            </h5>

            <div class="row fw-bold border-bottom pb-2 text-center d-none d-md-flex">
                <div class="col-md-6 text-start">Sản phẩm</div>
                <div class="col-md-2">Giá bán</div>
                <div class="col-md-2">Số lượng</div>
                <div class="col-md-2">Tạm tính</div>
            </div>

            <?php
            $totalPrice = 0;
            $cartIds = [];

            foreach ($carts as $cart):
                $itemTotal = $cart['size_price'] * $cart['quantity'];
                $totalPrice += $itemTotal;
                $cartIds[] = $cart['id'];
            ?>
                <div class="row align-items-start py-3 cart-row cart-item" data-id="<?= $cart['id'] ?>" data-total="<?= $itemTotal ?>">
                    <div class="col-md-6">
                        <div class="product-info">
                            <img src="/Du_an_1/Assets/image/products/<?= htmlspecialchars($cart['product_image']) ?>" alt="Sản phẩm">
                            <div>
                                <div class="product-name"><?= htmlspecialchars($cart['product_name']) ?></div>
                                <div class="product-size">Size: <?= htmlspecialchars($cart['size_name']) ?></div>
                            </div>
                        </div>
                        <button class="btn btn-outline-danger btn-sm btn-delete-item mt-3" data-id="<?= $cart['id'] ?>">🗑 Xóa</button>
                    </div>
                    <div class="col-md-2 text-center mt-3 mt-md-0"><?= number_format($cart['size_price'], 0, ',', '.') ?> ₫</div>
                    <div class="col-md-2 text-center mt-3 mt-md-0"><?= $cart['quantity'] ?></div>
                    <div class="col-md-2 text-center mt-3 mt-md-0 fw-bold text-danger item-total"><?= number_format($itemTotal, 0, ',', '.') ?> ₫</div>
                </div>
            <?php endforeach; ?>

            <div class="text-end mt-4" id="cart-summary">
                <h4>Tổng cộng: <strong id="cart-total"><?= number_format($totalPrice, 0, ',', '.') ?> ₫</strong></h4>
                <a href="?action=order&id_cart=<?= $id_cart ?>" class="btn btn-success mt-2">💳 Thanh toán</a>
            </div>
        <?php else: ?>
            <p class="alert alert-warning text-center mt-5">🛒 Giỏ hàng trống.</p>
        <?php endif; ?>
    </div>

    <script>
        $(document).ready(function() {
            $('.btn-delete-item').click(function() {
                if (!confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) return;

                const button = $(this);
                const itemId = button.data('id');
                const row = button.closest('.cart-item');
                const itemTotal = parseFloat(row.data('total'));

                $.ajax({
                    url: "/Du_an_1/View/Client/index.php",
                    method: "GET",
                    data: {
                        action: "removeFromCart",
                        id: itemId
                    },
                    success: function() {
                        row.remove();

                        // Cập nhật tổng cộng
                        let currentTotal = parseFloat($('#cart-total').text().replace(/\./g, '').replace(' ₫', ''));
                        let newTotal = currentTotal - itemTotal;
                        $('#cart-total').text(newTotal.toLocaleString('vi-VN') + ' ₫');

                        // Cập nhật số lượng sản phẩm
                        let productCount = $('.cart-item').length;
                        $('#cart-count-text').text("🧾 Bạn có " + productCount + " sản phẩm trong giỏ hàng.");

                        // Nếu giỏ hàng trống
                        if (productCount === 0) {
                            $('.row.fw-bold').remove();
                            $('#cart-summary').remove();
                            $('.container').append('<p class="alert alert-warning text-center mt-5">🛒 Giỏ hàng trống.</p>');
                        }
                    },
                    error: function() {
                        alert("Có lỗi xảy ra khi xóa sản phẩm.");
                    }
                });
            });
        });
    </script>

</body>

<script>
    <?php if (isset($message)): ?>

        Swal.fire({
            icon: '<?php echo $type; ?>',
            title: '<?php echo $message; ?>',
            showConfirmButton: true,
            position: 'top',
            toast: true,
            timer: 3000,
            timerProgressBar: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        });
    <?php endif; ?>
</script>

</html>