<div class="container py-5">
    <?php if (!empty($orderDetail)) :
        $order = $orderDetail[0];

        $statusText = htmlspecialchars($order['status']);
        $statusClass = 'secondary'; 

        switch (strtolower($statusText)) {
            case 'đã giao':
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
        }
    ?>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h2 class="text-primary mb-0">
                Chi tiết đơn hàng #<?= htmlspecialchars($order['id_order']) ?>
            </h2>
            <span class="badge bg-<?= $statusClass ?> px-3 py-2 text-capitalize">
                <?= $statusText ?>
            </span>
        </div>

        <div class="card mb-4 border-primary">
            <div class="card-header bg-primary text-white">
                <strong>Thông tin người nhận</strong>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Họ tên:</strong> <?= htmlspecialchars($order['customer_name']) ?></li>
                    <li class="list-group-item"><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['address']) ?></li>
                    <li class="list-group-item"><strong>Điện thoại:</strong> <?= htmlspecialchars($order['phone']) ?></li>
                    <li class="list-group-item"><strong>Ngày nhận:</strong> <?= htmlspecialchars($order['received_date']) ?> lúc <?= htmlspecialchars($order['received_time']) ?></li>
                    <li class="list-group-item"><strong>Hình thức thanh toán:</strong> <?= htmlspecialchars($order['payment']) ?></li>
                </ul>
            </div>
        </div>

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
                                <td><img src="/Du_an_1/Assets/image/products/<?= htmlspecialchars($item['product_image']) ?>" style="width: 60px;" class="rounded"></td>
                                <td><?= htmlspecialchars($item['product_name']) ?></td>
                                <td><?= htmlspecialchars($item['product_description']) ?></td>
                                <td><?= htmlspecialchars($item['id_size']) ?></td>
                                <td><?= htmlspecialchars($item['quantity']) ?></td>
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
