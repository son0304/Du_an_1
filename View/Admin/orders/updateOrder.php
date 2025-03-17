<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Cập nhật đơn hàng</h2>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $order['id'] ?>">
            
            <div class="row">
                
                <div class="col-6 mt-2">
                    <label class="form-label">Tên sản phẩm</label>
                    <select name="id_productsize" class="form-control" required>
                        <?php foreach ($product_sizes as $product_size): ?>
                            <option value="<?= $product_size['id'] ?>"><?= $product_size['id_product'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-6 mt-2">
                    <label class="form-label">Kích cỡ</label>
                    <select name="id_productsize" class="form-control" required>
                        <?php foreach ($product_sizes as $product_size): ?>
                            <option value="<?= $product_size['id'] ?>"><?= $product_size['id_size'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-6 mt-2">
                    <label class="form-label">Giá</label>
                    <select name="id_productsize" class="form-control" required>
                        <?php foreach ($product_sizes as $product_size): ?>
                            <option value="<?= $product_size['id'] ?>"><?= number_format($product_size['price'], 0, ',', '.') ?> VND</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-6 mt-2">
                    <label class="form-label">Tên khách hàng</label>
                    <input type="text" name="name" class="form-control" value="<?= $order['name'] ?>" required>
                </div>

                <div class="col-6 mt-2">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" name="address" class="form-control" value="<?= $order['address'] ?>" required>
                </div>

                <div class="col-6 mt-2">
                    <label class="form-label">SĐT</label>
                    <input type="text" name="phone" class="form-control" value="<?= $order['phone'] ?>" required>
                </div>

                <div class="col-6 mt-2">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-control" required>
                        <option value="<?= STATUS_UNCOMFIRMED ?>"><?= ucfirst(strtolower(STATUS_UNCOMFIRMED)) ?></option>
                        <option value="<?= STATUS_CONFIRMED ?>"><?= ucfirst(strtolower(STATUS_CONFIRMED)) ?></option>
                        <option value="<?= STATUS_SHIPPED ?>"><?= ucfirst(strtolower(STATUS_SHIPPED)) ?></option>
                        <option value="<?= STATUS_CANCELLED ?>"><?= ucfirst(strtolower(STATUS_CANCELLED)) ?></option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mt-4 text-center">
                    <button type="submit" class="btn btn-success">Cập nhật</button>
                    <a href="dashboard.php?action=orders" class="btn btn-secondary">Hủy</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
