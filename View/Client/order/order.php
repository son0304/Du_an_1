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

                        <?php foreach ($products as $product) : ?>
                            <?php
                            $quantity = isset($_GET['id_cart']) ? $product['quantity'] : 1;
                            $price = $product['price'];
                            ?>
                            <div class="row align-items-center mb-3 border-bottom pb-3">
                                <div class="col-3">
                                    <img src="/Du_an_1/Assets/image/products/<?= htmlspecialchars($product['img']) ?>" alt="Ảnh sản phẩm" class="img-fluid rounded">
                                </div>
                                <div class="col-9">
                                    <h6 class="mb-1"><?= htmlspecialchars($product['name']) ?></h6>
                                    <p class="text-danger fw-bold mb-2">Giá: <?= number_format($price, 0, ',', '.') ?> ₫</p>
                                    <div class="mb-2">
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
                            <input type="text" id="name" name="name" placeholder="Nhập tên" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" class="form-control" required>
                            <div id="phoneError" class="text-danger d-none">Số điện thoại không hợp lệ. Vui lòng nhập lại!</div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" id="address" name="address" placeholder="Nhập địa chỉ" class="form-control" required>
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
                            <div id="timeError" class="text-danger d-none mt-2">Thời gian nhận bánh từ 8-21h. Giờ nhận phải cách giờ hiện tại ít nhất 1 tiếng!</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block">Hình thức thanh toán</label>
                            <div class="d-flex justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment" id="cod" value="COD" checked>
                                    <label class="form-check-label" for="cod">COD</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment" id="bank" value="BANK">
                                    <label class="form-check-label" for="bank">Chuyển khoản</label>
                                </div>
                            </div>
                        </div>

                        <div id="bankInfo" class="alert alert-info d-none">
                            <p class="mb-1"><strong>Thông tin chuyển khoản:</strong></p>
                            <ul class="mb-0">
                                <li>Ngân hàng: Vietcombank</li>
                                <li>Số tài khoản: 0123456789</li>
                                <li>Chủ tài khoản: Nguyễn Văn A</li>
                                <li>Nội dung chuyển khoản: <strong>SDT + Tên</strong></li>
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

        function toggleBankInfo() {
            const bankInfo = document.getElementById('bankInfo');
            const isBankSelected = document.getElementById('bank').checked;
            bankInfo.classList.toggle('d-none', !isBankSelected);
        }

        function validatePhone(phone) {
            const phoneRegex = /^(0[3|5|7|8|9])+([0-9]{8})$/;
            return phoneRegex.test(phone);
        }

        function validateDate(date) {
            const today = new Date();
            const selectedDate = new Date(date);
            return selectedDate >= today;
        }

        function validateTime(time) {
            const currentTime = new Date();
            const selectedTime = new Date(currentTime.toDateString() + ' ' + time);

            const currentDate = currentTime.toDateString();
            const selectedDate = selectedTime.toDateString();
            const selectedHour = selectedTime.getHours();
            if (selectedHour < 8 || selectedHour >= 21) {
                return false;
            }

            // Nếu chọn thời gian trong ngày hôm nay, phải sau thời điểm hiện tại ít nhất 1 tiếng
            if (currentDate === selectedDate) {
                const oneHourLater = new Date(currentTime.getTime() + 60 * 60 * 1000);
                return selectedTime >= oneHourLater;
            }
            return true;
        }


        window.addEventListener('DOMContentLoaded', () => {
            updateTotalPrice();
            toggleBankInfo();

            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('input', updateTotalPrice);
            });

            document.getElementsByName('payment').forEach(radio => {
                radio.addEventListener('change', toggleBankInfo);
            });

            const orderForm = document.getElementById('orderForm');
            orderForm.addEventListener('submit', (event) => {
                let valid = true;

                const phone = document.getElementById('phone').value;
                if (!validatePhone(phone)) {
                    document.getElementById('phoneError').classList.remove('d-none');
                    valid = false;
                } else {
                    document.getElementById('phoneError').classList.add('d-none');
                }

                const receivedDate = document.getElementById('received_date').value;
                if (!validateDate(receivedDate)) {
                    document.getElementById('dateError').classList.remove('d-none');
                    valid = false;
                } else {
                    document.getElementById('dateError').classList.add('d-none');
                }

                const receivedTime = document.getElementById('received_time').value;
                if (!validateTime(receivedTime)) {
                    document.getElementById('timeError').classList.remove('d-none');
                    valid = false;
                } else {
                    document.getElementById('timeError').classList.add('d-none');
                }

                if (!valid) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>

</html>