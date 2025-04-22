<?php
$message = $_SESSION['message'] ?? null;
$type = $_SESSION['type'] ?? null;
unset($_SESSION['message'], $_SESSION['type']);
?>
<div class="container py-5">
    <?php if (!empty($orderDetail)) :
        $order = $orderDetail[0];

        $statusClass = match (strtolower($order['status'])) {
            'hoàn tất', 'đã giao' => 'success',
            'đang xử lý' => 'warning',
            'đang giao' => 'info',
            'đã huỷ' => 'secondary',
            default => 'danger'
        };
    ?>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0 fw-bold text-dark">
                Đơn hàng <span class="text-primary">#<?= htmlspecialchars($order['id_order']) ?></span>
            </h4>
            <span class="badge bg-<?= $statusClass ?> px-3 py-2 text-capitalize fs-7">
                <?= htmlspecialchars($order['status']) ?>
            </span>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Danh sách sản phẩm</h5>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th>Ảnh</th>
                                    <th>Tên SP</th>
                                    <th>Size</th>
                                    <th>SL</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orderDetail as $item) : ?>
                                    <tr class="text-center">
                                        <td>
                                            <img src="/Du_an_1/Assets/image/products/<?= htmlspecialchars($item['product_image']) ?>"
                                                alt=""
                                                class="rounded"
                                                style="width: 60px; height: auto;">
                                        </td>
                                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                                        <td><?= htmlspecialchars($item['id_size']) ?></td>
                                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                                        <td><?= number_format($item['unit_price'], 0, ',', '.') ?>đ</td>
                                        <td><?= number_format($item['unit_price'] * $item['quantity'], 0, ',', '.') ?>đ</td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tổng cộng:</span>
                            <strong class="text-primary"><?= number_format($order['total_price'], 0, ',', '.') ?>đ</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Thanh toán:</span>
                            <span><?= htmlspecialchars($order['payment']) ?></span>
                        </div>
                        <?php if ($order['status'] === 'chờ xác nhận') : ?>
                            <form method="post" class="mt-3">
                                <input type="hidden" name="status" value="đã huỷ">
                                <input type="hidden" name="id_order" value="<?= htmlspecialchars($order['id_order']) ?>">
                                <button type="submit" name="cancel_order"
                                    class="btn btn-outline-danger w-25"
                                    onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?')">
                                    Hủy đơn hàng
                                </button>
                            </form>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Thông tin người nhận</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" onsubmit="return validateForm()">
                            <input type="hidden" name="id_order" value="<?= htmlspecialchars($order['id_order']) ?>">

                            <div class="mb-3">
                                <label for="customer_name" class="form-label"><strong>Họ tên:</strong></label>
                                <input type="text" class="form-control form-control-sm" id="name" name="name" value="<?= htmlspecialchars($order['customer_name']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label"><strong>Số điện thoại:</strong></label>
                                <input type="text" class="form-control form-control-sm" id="phone" name="phone" value="<?= htmlspecialchars($order['phone']) ?>" required>
                                <div id="phoneError" class="text-danger d-none">Số điện thoại không hợp lệ. Vui lòng nhập lại!</div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label"><strong>Địa chỉ:</strong></label>
                                <textarea class="form-control form-control-sm" id="address" name="address" rows="2" required><?= htmlspecialchars($order['address']) ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="received_date" class="form-label"><strong>Ngày nhận:</strong></label>
                                <input type="date" class="form-control form-control-sm" id="received_date" name="received_date" value="<?= htmlspecialchars($order['received_date']) ?>" required>
                                <div id="dateError" class="text-danger d-none">Không được đặt cho quá khứ</div>

                            </div>

                            <div class="mb-3">
                                <label for="received_time" class="form-label"><strong>Giờ nhận:</strong></label>
                                <input type="time" class="form-control form-control-sm" id="received_time" name="received_time" value="<?= htmlspecialchars($order['received_time']) ?>" required>
                                <div id="timeError" class="text-danger d-none mt-2">Giờ nhận phải cách giờ hiện tại ít nhất 1 tiếng!</div>

                            </div>

                            <div class="mb-3" hidden>
                                <label for="payment" class="form-label"><strong>Phương thức:</strong></label>
                                <select class="form-select form-select-sm" id="payment" name="payment" required>
                                    <option value="COD" <?= $order['payment'] == 'COD' ? 'selected' : '' ?>>Thanh toán khi nhận hàng</option>
                                    <option value="Chuyển khoản" <?= $order['payment'] == 'Chuyển khoản' ? 'selected' : '' ?>>Chuyển khoản</option>
                                </select>
                            </div>
                            <?php if ($order['status'] === 'chờ xác nhận') : ?>
                                <form method="post" class="mt-3">
                                    <input type="hidden" name="status" value="đã huỷ">
                                    <input type="hidden" name="id_order" value="<?= htmlspecialchars($order['id_order']) ?>">
                                    <button type="submit" name="update_order" class="btn btn-primary w-100">Lưu thay đổi</button>
                                </form>
                            <?php endif ?>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    <?php else : ?>
        <div class="alert alert-warning">Không tìm thấy đơn hàng.</div>
    <?php endif; ?>
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
        if (currentDate === selectedDate) {
            return selectedTime >= new Date(currentTime.getTime() + 60 * 60 * 1000);
        }
        return true;
    }
</script>