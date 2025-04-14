<div class="py-5">
    <h2 class="text-primary mb-4 text-center">Danh sách đơn hàng (Admin)</h2>

    <?php if (!empty($orders)) : ?>
        <div class="rounded table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr> 
                        <th scope="col">Mã Đơn</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Ngày nhận</th>
                        <th scope="col">Thanh toán</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Ngày đặt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <?php
                        // Xử lý trạng thái hiển thị màu sắc
                        $statusClass = 'secondary';
                        switch (strtolower($order['status'])) {
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
                        <tr>
                            <td class="text-center">
                                <a href="?action=detailOrder&id=<?= $order['id'] ?>" class="badge bg-<?= $statusClass ?>"><?= $order['id'] ?></a>
                            </td>
                            <td>
                                <small><strong><?= ($order['name']) ?></strong><br>
                                <?= ($order['phone']) ?></small>
                            </td>
                            <td class="text-center">
                                <small><?= ($order['received_time']) ?><br>
                                <?= ($order['received_date']) ?></small>
                            </td>
                            <td class="text-center"><small><?= ($order['payment']) ?></small></td>
                            <td class="text-center">
                                <span class="badge bg-<?= $statusClass ?> text-capitalize"><?= ($order['status']) ?></span>
                            </td>
                            <td class="text-center"><small><?= number_format($order['total_price'], 0, ',', '.') ?>đ</small></td>
                            <td class="text-center"><small><?= ($order['created_at']) ?></small></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="alert alert-info text-center">Không có đơn hàng nào.</div>
    <?php endif; ?>
</div>

<style>
    /* Đặt màu sắc cho các trạng thái */
    .badge.bg-success {
        background-color: #00C77F;
    }
    .badge.bg-warning {
        background-color: #ffc107;
    }
    .badge.bg-danger {
        background-color: #dc3545;
    }
    .badge.bg-info {
        background-color: #17a2b8;
    }

    /* Định dạng lại kích thước chữ nhỏ */
    td small, th small {
        font-size: 0.85rem;
    }

    /* Sử dụng nền sáng cho tiêu đề bảng */
    .thead-light {
        background-color: #f8f9fa;
    }

    /* Hiệu ứng hover cho dòng bảng */
    table tr:hover {
        background-color: #f1f1f1;
    }

    /* Tùy chỉnh giao diện bảng để không có viền */
    table {
        width: 100%;
    }
    th, td {
        padding: 12px;
        text-align: center;
    }

    /* Đảm bảo chiều rộng bảng không bị cắt khi có quá nhiều dữ liệu */
    .table-responsive {
        overflow-x: auto;
    }
</style>
