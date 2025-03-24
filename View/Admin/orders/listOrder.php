<?php
session_start();
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']); // Xóa thông báo sau khi hiển thị
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="mt-4">
        <h2 class="text-center">Danh sách đơn hàng</h2>
        <table class="table table-bordered">
            <thead class="table">
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
                        <td><?= $order['name']?></td>
                        <td><?= $order['address']?></td>
                        <td><?= $order['phone']?></td>
                        <td><?= $order['status']?></td>
                        <td><?= $order['created_at']?></td>
                        <td>
                            <a href="dashboard.php?action=updateOrder&id=<?= $order['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="dashboard.php?action=deleteOrder&id=<?= $order['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="dashboard.php?action=createOrder" class="btn btn-primary">Tạo mới đơn hàng</a>
    </div>    
</body>
</html>