<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container py-5">
        <form action="" method="post">
            <div class="row g-4">
                <!-- Danh sách sản phẩm -->
                <div class="col-lg-8">
                    <div class="card p-4">
                        <h4 class="text-center text-primary mb-4">Thông tin sản phẩm</h4>

                        <?php foreach ($products as $product) : ?>
                            <div class="row align-items-center mb-3 border-bottom pb-3">
                                <div class="col-3">
                                    <img src="/Du_an_1/Assets/image/products/<?= htmlspecialchars($product['img']) ?>" alt="Ảnh sản phẩm" class="img-fluid rounded">
                                </div>
                                <div class="col-9">
                                    <h6 class="mb-1"><?= htmlspecialchars($product['name']) ?></h6>
                                    <p class="text-danger fw-bold mb-2">Giá: <?= number_format($price, 0, ',', '.') ?> ₫</p>
                                    <div class="mb-2">
                                        <label for="quantity_<?= $product['id'] ?>" class="form-label">Số lượng</label>
                                        <input type="number"
                                            name="quantity[<?= $product['id'] ?>]"
                                            id="quantity_<?= $product['id'] ?>"
                                            class="form-control form-control-sm w-50 quantity-input"
                                            min="1"
                                            value="1"
                                            data-price="<?= $price ?>">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>

                <!-- Thông tin đơn hàng -->
                <div class="col-lg-4">
                    <div class="card p-4">
                        <h4 class="text-center text-primary mb-4">Thông tin đơn hàng</h4>

                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và Tên</label>
                            <input type="text" id="name" name="name" placeholder="Nhập tên" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" id="address" name="address" placeholder="Nhập địa chỉ" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="received_date" class="form-label">Ngày nhận</label>
                            <input type="date" id="received_date" name="received_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="received_time" class="form-label">Giờ nhận</label>
                            <select id="received_time" name="received_time" class="form-select" required>
                                <option value="08:00">08:00</option>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                                <option value="21:00">21:00</option>
                            </select>
                        </div>

                        <!-- Hình thức thanh toán -->
                        <div class="mb-3">
                            <label class="form-label d-block">Hình thức thanh toán</label>
                            <div class="d-flex justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment" id="cod" value="COD" checked>
                                    <label class="form-check-label" for="cod"> (COD)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment" id="bank" value="BANK">
                                    <label class="form-check-label" for="bank">Chuyển khoản</label>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin chuyển khoản -->
                        <div id="bankInfo" class="alert alert-info d-none">
                            <p class="mb-1"><strong>Thông tin chuyển khoản:</strong></p>
                            <ul class="mb-0">
                                <li>Ngân hàng: Vietcombank</li>
                                <li>Số tài khoản: 0123456789</li>
                                <li>Chủ tài khoản: Nguyễn Văn A</li>
                                <li>Nội dung chuyển khoản: <strong>SDT + Tên</strong></li>
                            </ul>
                        </div>

                        <!-- Tổng tiền -->
                        <div class="mb-3">
                            <strong class="text-danger">Tổng tiền: <span id="totalPriceText">0</span> VND</strong>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Xác nhận đặt hàng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- JavaScript tính tổng tiền và hiển thị hình thức thanh toán -->
    <script>
        function formatCurrency(number) {
            return number.toLocaleString('vi-VN');
        }

        function updateTotalPrice() {
            const quantityInputs = document.querySelectorAll('.quantity-input');
            let total = 0;

            quantityInputs.forEach(input => {
                const price = parseFloat(input.dataset.price);
                const quantity = parseInt(input.value) || 0;
                total += price * quantity;
            });

            document.getElementById('totalPriceText').textContent = formatCurrency(total);
        }

        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('input', updateTotalPrice);
        });

        updateTotalPrice();

        // Hiển thị thông tin chuyển khoản nếu chọn hình thức chuyển khoản
        const codRadio = document.getElementById('cod');
        const bankRadio = document.getElementById('bank');
        const bankInfo = document.getElementById('bankInfo');

        codRadio.addEventListener('change', () => {
            bankInfo.classList.add('d-none');
        });

        bankRadio.addEventListener('change', () => {
            bankInfo.classList.remove('d-none');
        });
    </script>
</body>

</html>