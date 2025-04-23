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
        <form action="" method="post" id="orderForm">
            <div class="row g-4">
                <!-- Thông tin sản phẩm -->
                <div class="col-lg-8">
                    <div class="card p-4">
                        <h4 class="text-center text-primary mb-4">Thông tin sản phẩm</h4>
                        <?php foreach ($products as $product) : 
                            $quantity = isset($_GET['id_cart']) ? $product['quantity'] : 1;
                            $price = $product['price'];
                        ?>
                            <div class="row align-items-center mb-3 border-bottom pb-3">
                                <div class="col-3">
                                    <img src="/Du_an_1/Assets/image/products/<?= htmlspecialchars($product['img']) ?>" alt="Ảnh sản phẩm" class="img-fluid rounded">
                                </div>
                                <div class="col-9">
                                    <h6><?= htmlspecialchars($product['name']) ?></h6>
                                    <p class="text-danger fw-bold mb-2">Giá: <?= number_format($price, 0, ',', '.') ?> ₫</p>
                                    <div>
                                        <label for="quantity_<?= $product['id'] ?>" class="form-label">Số lượng</label>
                                        <input type="number" name="quantity[]" id="quantity_<?= $product['id'] ?>" class="form-control form-control-sm w-50 quantity-input" min="1" value="<?= $quantity ?>" data-price="<?= $price ?>">
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
                            <input type="text" id="name" name="name" class="form-control" placeholder="Nhập tên" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại" required>
                            <div id="phoneError" class="text-danger d-none">Số điện thoại không hợp lệ. Vui lòng nhập lại!</div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" id="address" name="address" class="form-control" placeholder="Nhập địa chỉ" required>
                        </div>

                        <div class="mb-3">
                            <label for="received_date" class="form-label">Ngày nhận</label>
                            <input type="date" id="received_date" name="received_date" class="form-control" required>
                            <div id="dateError" class="text-danger d-none">Không được đặt cho quá khứ</div>
                        </div>

                        <div class="mb-3">
                            <label for="received_time" class="form-label">Giờ nhận</label>
                            <div class="d-flex align-items-center">
                                <input type="time" id="received_time" name="received_time" class="form-control me-2" required>
                                <span class="input-group-text">Giờ</span>
                            </div>
                            <div id="timeError" class="text-danger d-none mt-2">Thời gian nhận bánh từ 8-21h và cách hiện tại ít nhất 1 tiếng!</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block">Hình thức thanh toán</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="payment" id="cod" value="COD" checked>
                                <label class="form-check-label" for="cod">COD</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="payment" id="bank" value="BANK">
                                <label class="form-check-label" for="bank">Chuyển khoản</label>
                            </div>
                        </div>

                        <div id="bankInfo" class="alert alert-info d-none">
                            <strong>Thông tin chuyển khoản:</strong>
                            <ul>
                                <li>Ngân hàng: Vietcombank</li>
                                <li>Số tài khoản: 0123456789</li>
                                <li>Chủ tài khoản: Nguyễn Văn A</li>
                                <li>Nội dung: <strong>SDT + Tên</strong></li>
                            </ul>
                        </div>

                        <div class="mb-3">
                            <strong class="text-danger">Tổng tiền: <span id="totalPriceText">0</span> VND</strong>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Xác nhận đặt hàng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Cập nhật tổng tiền
        function updateTotalPrice() {
            const inputs = document.querySelectorAll('.quantity-input');
            let total = 0;
            inputs.forEach(input => {
                const price = parseFloat(input.dataset.price);
                const quantity = parseInt(input.value) || 0;
                total += price * quantity;
            });
            document.getElementById('totalPriceText').textContent = total.toLocaleString('vi-VN');
        }

        // Hiển thị thông tin chuyển khoản nếu chọn BANK
        function toggleBankInfo() {
            document.getElementById('bankInfo').classList.toggle('d-none', !document.getElementById('bank').checked);
        }

        // Kiểm tra số điện thoại
        function validatePhone(phone) {
            return /^(0[3|5|7|8|9])\d{8}$/.test(phone);
        }

        // Kiểm tra ngày không phải quá khứ
        function validateDate(date) {
            const today = new Date();
            const selected = new Date(date);
            today.setHours(0, 0, 0, 0);
            selected.setHours(0, 0, 0, 0);
            return selected >= today;
        }

        // Kiểm tra giờ đặt hợp lệ
        function validateTime(time, dateStr) {
            const [h, m] = time.split(':');
            const now = new Date();
            const selectedTime = new Date(`${dateStr}T${h}:${m}`);
            const selectedHour = selectedTime.getHours();
            if (selectedHour < 8 || selectedHour >= 21) return false;
            if (dateStr === now.toISOString().split('T')[0]) {
                return selectedTime.getTime() >= now.getTime() + 3600000;
            }
            return true;
        }

        // Sự kiện DOM
        document.addEventListener('DOMContentLoaded', () => {
            updateTotalPrice();
            toggleBankInfo();

            document.querySelectorAll('.quantity-input').forEach(input =>
                input.addEventListener('input', updateTotalPrice)
            );

            document.querySelectorAll('[name="payment"]').forEach(radio =>
                radio.addEventListener('change', toggleBankInfo)
            );

            document.getElementById('orderForm').addEventListener('submit', (e) => {
                let valid = true;

                const phone = document.getElementById('phone').value;
                if (!validatePhone(phone)) {
                    document.getElementById('phoneError').classList.remove('d-none');
                    valid = false;
                } else {
                    document.getElementById('phoneError').classList.add('d-none');
                }

                const date = document.getElementById('received_date').value;
                if (!validateDate(date)) {
                    document.getElementById('dateError').classList.remove('d-none');
                    valid = false;
                } else {
                    document.getElementById('dateError').classList.add('d-none');
                }

                const time = document.getElementById('received_time').value;
                if (!validateTime(time, date)) {
                    document.getElementById('timeError').classList.remove('d-none');
                    valid = false;
                } else {
                    document.getElementById('timeError').classList.add('d-none');
                }

                if (!valid) e.preventDefault();
            });
        });
    </script>

    <!-- Nếu có thông báo từ PHP -->
    <?php if (isset($message)) : ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: '<?= $type ?>',
                title: '<?= $message ?>',
                toast: true,
                position: 'top',
                timer: 3000,
                showConfirmButton: true,
                timerProgressBar: true,
                showClass: { popup: 'animate__animated animate__fadeInDown' },
                hideClass: { popup: 'animate__animated animate__fadeOutUp' }
            });
        </script>
    <?php endif; ?>
</body>

</html>
