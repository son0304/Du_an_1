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
                        <?php foreach ($products as $index => $product) :
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
                                        <input type="number"
                                            name="quantity[<?= $product['id'] ?>]"
                                            id="quantity_<?= $product['id'] ?>"
                                            class="form-control form-control-sm w-50 quantity-input"
                                            min="1"
                                            value="<?= $quantity ?>"
                                            data-price="<?= $price ?>"
                                            data-id="<?= $product['id'] ?>"
                                            required>
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
                            <div id="nameError" class="text-danger small mt-1 d-none">Vui lòng nhập họ và tên</div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại" required>
                            <div id="phoneError" class="text-danger small mt-1 d-none">Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại Việt Nam</div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" id="address" name="address" class="form-control" placeholder="Nhập địa chỉ" required>
                            <div id="addressError" class="text-danger small mt-1 d-none">Vui lòng nhập địa chỉ</div>
                        </div>

                        <div class="mb-3">
                            <label for="received_date" class="form-label">Ngày nhận</label>
                            <input type="date" id="received_date" name="received_date" class="form-control" required>
                            <div id="dateError" class="text-danger small mt-1 d-none">Không được đặt cho quá khứ</div>
                        </div>

                        <div class="mb-3">
                            <label for="received_time" class="form-label">Giờ nhận</label>
                            <div class="input-group">
                                <input
                                    type="time"
                                    id="received_time"
                                    name="received_time"
                                    class="form-control"
                                    required>
                                <span class="input-group-text">Giờ</span>
                            </div>
                            <div
                                id="timeError"
                                class="invalid-feedback d-block d-none text-danger small mt-1">
                                Thời gian nhận bánh từ 08:00 đến 22:00 và cách giờ hiện tại ít nhất 1 tiếng!
                            </div>
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
                            <strong class="text-danger">Tổng tiền: <span id="totalPriceText">0</span> ₫</strong>
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

        // Thêm sự kiện khi thay đổi số lượng
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('input', updateTotalPrice);
            input.addEventListener('change', updateTotalPrice);
        });

        // Cập nhật tổng tiền khi load trang
        document.addEventListener('DOMContentLoaded', updateTotalPrice);

        // Validate ngày và giờ nhận
        function validateDateTime() {
            const receivedDate = new Date(document.getElementById('received_date').value);
            const receivedTime = document.getElementById('received_time').value;
            const now = new Date();
            const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());

            const dateError = document.getElementById('dateError');
            const timeError = document.getElementById('timeError');
            const timeInput = document.getElementById('received_time');
            const dateInput = document.getElementById('received_date');
            let isValid = true;

            // Kiểm tra ngày không được là quá khứ
            if (receivedDate < today) {
                isValid = false;
                dateError.classList.remove('d-none');
                dateInput.classList.add('is-invalid');
                return false;
            }

            // Chuyển đổi thời gian nhập vào thành 24h format
            const [time, period] = receivedTime.split(' ');
            const [hours, minutes] = time.split(':');
            let hour24 = parseInt(hours);

            if (period === 'CH' && hour24 < 12) {
                hour24 += 12;
            } else if (period === 'SA' && hour24 === 12) {
                hour24 = 0;
            }

            // Tạo đối tượng Date cho thời gian được chọn
            const selectedTime = new Date(receivedDate);
            selectedTime.setHours(hour24, parseInt(minutes), 0, 0);

            // Kiểm tra thời gian không được là quá khứ
            if (selectedTime < now) {
                isValid = false;
                timeError.classList.remove('d-none');
                timeInput.classList.add('is-invalid');
                return false;
            }

            // Kiểm tra giờ nhận từ 8h đến 22h
            if (hour24 < 8 || hour24 > 22) {
                isValid = false;
                timeError.classList.remove('d-none');
                timeInput.classList.add('is-invalid');
                return false;
            }

            // Nếu là ngày hôm nay, kiểm tra thời gian cách hiện tại ít nhất 1 tiếng
            if (receivedDate.getTime() === today.getTime()) {
                if (selectedTime.getTime() < now.getTime() + 3600000) {
                    isValid = false;
                    timeError.classList.remove('d-none');
                    timeInput.classList.add('is-invalid');
                    return false;
                }
            }

            // Nếu hợp lệ, xóa class is-invalid
            if (isValid) {
                timeInput.classList.remove('is-invalid');
                dateInput.classList.remove('is-invalid');
                timeError.classList.add('d-none');
                dateError.classList.add('d-none');
            }

            return isValid;
        }

        // Set min time cho input time
        document.getElementById('received_time').addEventListener('change', validateDateTime);
        document.getElementById('received_time').addEventListener('blur', validateDateTime);

        // Validate ngày nhận khi thay đổi
        document.getElementById('received_date').addEventListener('change', validateDateTime);

        // Set min date cho input date
        document.getElementById('received_date').min = new Date().toISOString().split('T')[0];

        // Set max time cho input time
        document.getElementById('received_time').max = '10:00 CH';

        // Set min time cho input time khi load trang
        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            const oneHourLater = new Date(now.getTime() + 3600000);

            // Set ngày mặc định là hôm nay
            document.getElementById('received_date').value = now.toISOString().split('T')[0];

            // Set giờ mặc định là giờ hiện tại + 1 tiếng
            const nextHour24 = oneHourLater.getHours();
            const nextMinutes = oneHourLater.getMinutes();

            // Chuyển đổi sang định dạng SA/CH
            let nextHour12 = nextHour24;
            let period = 'SA';

            if (nextHour24 >= 12) {
                period = 'CH';
                if (nextHour24 > 12) {
                    nextHour12 = nextHour24 - 12;
                }
            } else if (nextHour24 === 0) {
                nextHour12 = 12;
            }

            const nextTimeStr = `${nextHour12.toString().padStart(2, '0')}:${nextMinutes.toString().padStart(2, '0')} ${period}`;
            document.getElementById('received_time').value = nextTimeStr;

            validateDateTime();
        });

        // Validate form trước khi submit
        document.getElementById('orderForm').addEventListener('submit', function(e) {
            e.preventDefault();
            let isValid = true;

            // Validate tên
            const name = document.getElementById('name').value.trim();
            const nameError = document.getElementById('nameError');
            if (!name) {
                isValid = false;
                nameError.classList.remove('d-none');
            } else {
                nameError.classList.add('d-none');
            }

            // Validate số điện thoại
            const phone = document.getElementById('phone').value.trim();
            const phoneError = document.getElementById('phoneError');
            const phoneRegex = /^(0[3|5|7|8|9])+([0-9]{8})$/;
            if (!phoneRegex.test(phone)) {
                isValid = false;
                phoneError.classList.remove('d-none');
            } else {
                phoneError.classList.add('d-none');
            }

            // Validate địa chỉ
            const address = document.getElementById('address').value.trim();
            const addressError = document.getElementById('addressError');
            if (!address) {
                isValid = false;
                addressError.classList.remove('d-none');
            } else {
                addressError.classList.add('d-none');
            }

            // Validate ngày và giờ nhận
            if (!validateDateTime()) {
                isValid = false;
            }

            // Validate số lượng
            const quantityInputs = document.querySelectorAll('.quantity-input');
            quantityInputs.forEach(input => {
                if (parseInt(input.value) < 1) {
                    isValid = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                return false;
            }

            // Nếu tất cả đều hợp lệ, submit form
            this.submit();
        });

        // Validate số lượng khi nhập
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('input', function() {
                if (parseInt(this.value) < 1) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });
        });

        // Validate số điện thoại khi nhập
        document.getElementById('phone').addEventListener('input', function() {
            const phoneRegex = /^(0[3|5|7|8|9])+([0-9]{8})$/;
            const phoneError = document.getElementById('phoneError');
            if (!phoneRegex.test(this.value)) {
                this.classList.add('is-invalid');
                phoneError.classList.remove('d-none');
            } else {
                this.classList.remove('is-invalid');
                phoneError.classList.add('d-none');
            }
        });

        // Validate tên khi nhập
        document.getElementById('name').addEventListener('input', function() {
            const nameError = document.getElementById('nameError');
            if (!this.value.trim()) {
                this.classList.add('is-invalid');
                nameError.classList.remove('d-none');
            } else {
                this.classList.remove('is-invalid');
                nameError.classList.add('d-none');
            }
        });

        // Validate địa chỉ khi nhập
        document.getElementById('address').addEventListener('input', function() {
            const addressError = document.getElementById('addressError');
            if (!this.value.trim()) {
                this.classList.add('is-invalid');
                addressError.classList.remove('d-none');
            } else {
                this.classList.remove('is-invalid');
                addressError.classList.add('d-none');
            }
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
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        </script>
    <?php endif; ?>
</body>

</html>