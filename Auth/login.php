<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Đăng nhập</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Đăng nhập</h2>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']); // Xóa thông báo lỗi sau khi hiển thị
                ?>
            </div>
        <?php endif; ?>

        <form action="index.php?action=login" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail" 
                       value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword" class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword" required>
            </div>

            <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </form>
        
        <p class="mt-3">Chưa có tài khoản? <a href="index.php?action=registerform">Đăng ký ngay</a></p> <!-- Thêm liên kết đăng ký -->
    </div>
</body>
</html>