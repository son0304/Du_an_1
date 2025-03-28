<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Chỉnh sửa người dùng</h2>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']); // Xóa thông báo lỗi sau khi hiển thị ?>
            </div>
        <?php endif; ?>

        <form action="dashboard.php?action=editUser" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" name="name" class="form-control" id="name" value="<?= htmlspecialchars($user['name']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" id="phone" value="<?= htmlspecialchars($user['phone']) ?>">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" name="address" class="form-control" id="address" value="<?= htmlspecialchars($user['address']) ?>">
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="dashboard.php?action=users" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>