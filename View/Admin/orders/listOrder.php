<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Đơn hàng</h1>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">Danh sách đơn hàng</h6>
            <a href="dashboard.php?action=createOrder" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Thêm mới
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead">

                        <?php
                        if (isset($_SESSION['user'])) {
                            echo "Xin chào, " . $_SESSION['user']['name'];
                        } else {
                            echo "Bạn chưa đăng nhập!";
                        }
                        ?>
                        <tr>
                            <th>Người tạo</th>
                            <th>Tên sản phẩm</th>
                            <th>Kích cỡ</th>
                            <th>Giá</th>
                            <th>Tên khách hàng</th>
                            <th>Địa chỉ</th>
                            <th>SĐT</th>
                            <th>Trạng thái đơn hàng</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order as $order): ?>
                            <tr>
                                <td><?= $order['user_name'] ?></td>
                                <td><?= $order['pz_product'] ?></td>
                                <td><?= $order['pz_size'] ?></td>
                                <td><?= number_format($order['pz_price'], 0, ',', '.') ?> VND</td>
                                <td><?= $order['name'] ?></td>
                                <td><?= $order['address'] ?></td>
                                <td><?= $order['phone'] ?></td>
                                <td><?= $order['status'] ?></td>
                                <td><?= $order['created_at'] ?></td>
                                <td>
                                    <a href="dashboard.php?action=updateOrder&id=<?= $order['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>