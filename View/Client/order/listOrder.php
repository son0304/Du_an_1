<div class="container py-5">
    <h2 class="text-primary mb-4">Lịch sử đơn hàng của bạn</h2>

    <?php if (!empty($orders)) : ?>
        <?php
        $groupedOrders = [];
        foreach ($orders as $order) {
            $groupedOrders[$order['id_order']][] = $order;
        }
        ?>

        <?php foreach ($groupedOrders as $orderId => $orderItems):
            $firstItem = $orderItems[0];

            // Định dạng trạng thái với màu sắc
            $status = strtolower($firstItem['status']);
            $statusClasses = [
                'đã giao' => 'success',
                'hoàn tất' => 'success',
                'đang xử lý' => 'warning',
                'đang giao' => 'info',
                'đã huỷ' => 'danger',
            ];
            $badgeClass = $statusClasses[$status] ?? 'secondary';
        ?>
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Đơn hàng #<?= htmlspecialchars($orderId) ?></strong><br>
                        <small class="text-muted">Ngày đặt: <?= htmlspecialchars($firstItem['created_at']) ?></small>
                    </div>
                    <div>
                        <span class="badge bg-<?= $badgeClass ?> px-3 py-2 text-capitalize"><?= htmlspecialchars($firstItem['status']) ?></span>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php foreach ($orderItems as $item): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><?= htmlspecialchars($item['product_name']) ?></strong><br>
                                    <small>x<?= htmlspecialchars($item['quantity']) ?> • <?= number_format($item['unit_price'], 0, ',', '.') ?>đ</small>
                                </div>
                                <?php if (!empty($item['product_image'])): ?>
                                    <img src="/Du_an_1/Assets/image/products/<?= htmlspecialchars($item['product_image']) ?>" style="width: 60px;" class="rounded">
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Ngày nhận:</strong> <?= htmlspecialchars($firstItem['received_date']) ?> lúc <?= htmlspecialchars($firstItem['received_time']) ?></p>
                            <p class="mb-1"><strong>Thanh toán:</strong> <?= htmlspecialchars($firstItem['payment']) ?></p>
                        </div>
                        <div class="col-md-6 text-end">
                            <p class="mb-2"><strong>Tổng tiền:</strong> <span class="text-danger fw-bold"><?= number_format($firstItem['total_price'], 0, ',', '.') ?>đ</span></p>
                            <a href="?action=detailOrder&id=<?= $orderId ?>" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    <?php else : ?>
        <div class="alert alert-info text-center">
            Bạn chưa có đơn hàng nào. Hãy bắt đầu mua sắm ngay hôm nay!
        </div>
    <?php endif; ?>
</div>
