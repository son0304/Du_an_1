<?php
$message = $_SESSION['message'] ?? null;
$type = $_SESSION['type'] ?? null;
unset($_SESSION['message'], $_SESSION['type']);
?>
<div class="container py-5">
    <?php if (!empty($orderDetail)) :
        $order = $orderDetail[0];

        $statusText = strtolower($order['status']);
        $statusClass = 'secondary';

        // Mapping trạng thái -> màu sắc
        switch ($statusText) {
            case 'hoàn tất':
                $statusClass = 'success';
                break;
            case 'đang xử lý':
                $statusClass = 'warning';
                break;
            case 'đã huỷ':
                $statusClass = 'danger';
                break;
            case 'đang giao':
                $statusClass = 'info';
                break;
            case 'chờ xác nhận':
                $statusClass = 'secondary';
                break;
        }

        // Flow cập nhật trạng thái
        $statusFlow = [
            'chờ xác nhận' => 'đang xử lý',
            'đang xử lý'   => 'đang giao',
            'đang giao'    => 'hoàn tất'
        ];
    ?>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h2 class="text-primary mb-0">
                Chi tiết đơn hàng #<?= $order['id_order'] ?>
            </h2>
            <span class="badge bg-<?= $statusClass ?> px-3 py-2 text-capitalize">
                <?= ucfirst($statusText) ?>
            </span>
        </div>

        <!-- Nút chuyển trạng thái -->
        <div class="mb-4">
            <form method="post" action="" class="d-inline">
                <input type="hidden" name="id_order" value="<?= $order['id_order'] ?>">

                <?php if (isset($statusFlow[$statusText])) :
                    $nextStatus = $statusFlow[$statusText];

                    // Xác định màu sắc của nút chuyển trạng thái theo trạng thái tiếp theo
                    $nextStatusClass = 'secondary'; // Mặc định màu sắc là 'secondary'

                    switch ($nextStatus) {
                        case 'hoàn tất':
                            $nextStatusClass = 'success';
                            break;
                        case 'đang xử lý':
                            $nextStatusClass = 'warning';
                            break;
                        case 'đã huỷ':
                            $nextStatusClass = 'danger';
                            break;
                        case 'đang giao':
                            $nextStatusClass = 'info';
                            break;
                        case 'chờ xác nhận':
                            $nextStatusClass = 'secondary';
                            break;
                    }
                ?>
                    <button type="submit" name="new_status" value="<?= $nextStatus ?>" class="btn btn-<?= $nextStatusClass ?> me-2">
                        Chuyển sang: <?= ucfirst($nextStatus) ?>
                    </button>
                <?php endif; ?>

                <?php if ($statusText !== 'hoàn tất' && $statusText !== 'đã huỷ') : ?>
                    <button type="submit" name="new_status" value="đã huỷ" class="btn btn-outline-danger" onclick="return confirm('Bạn có chắc chắn muốn huỷ đơn hàng này?');">
                        Huỷ đơn hàng
                    </button>
                <?php endif; ?>
            </form>
        </div>

        <!-- Thông tin người nhận -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <strong>Thông tin người nhận</strong>
            </div>
            <div class="card-body bg-light">
                <div class="row">
                    <div class="col-md-6 mb-2"><strong>Họ tên:</strong> <?= $order['customer_name'] ?></div>
                    <div class="col-md-6 mb-2"><strong>Điện thoại:</strong> <?= $order['phone'] ?></div>
                    <div class="col-md-6 mb-2"><strong>Địa chỉ:</strong> <?= $order['address'] ?></div>
                    <div class="col-md-6 mb-2"><strong>Ngày nhận:</strong> <?= $order['received_date'] ?> lúc <?= $order['received_time'] ?></div>
                    <div class="col-md-6 mb-2"><strong>Hình thức thanh toán:</strong> <?= $order['payment'] ?></div>
                </div>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <strong>Sản phẩm trong đơn hàng</strong>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Mô tả</th>
                            <th>Size</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orderDetail as $item) : ?>
                            <tr>
                                <td><img src="/Du_an_1/Assets/image/products/<?= $item['product_image'] ?>" style="width: 60px;" class="rounded"></td>
                                <td><?= $item['product_name'] ?></td>
                                <td><?= $item['product_description'] ?></td>
                                <td><?= $item['id_size'] ?></td>
                                <td><?= $item['quantity'] ?></td>
                                <td><?= number_format($item['unit_price'], 0, ',', '.') ?>đ</td>
                                <td><?= number_format($item['unit_price'] * $item['quantity'], 0, ',', '.') ?>đ</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="text-end mt-3">
                    <h5 class="text-primary">Tổng tiền: <?= number_format($order['total_price'], 0, ',', '.') ?>đ</h5>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="alert alert-warning mt-4">Không tìm thấy đơn hàng.</div>
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
</script>