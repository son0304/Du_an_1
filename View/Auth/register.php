<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng ký tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4 rounded-4" style="width: 100%; max-width: 500px;">
            <h2 class="text-center mb-4">Đăng ký tài khoản</h2>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['error'];
                    unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success" role="alert">
                    <?= $_SESSION['success'];
                    unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_URL . 'Router/clientRouter.php?action=register' ?>" method="POST" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="inputName" class="form-label">Họ và tên</label>
                    <input type="text" name="name" id="inputName" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" name="email" id="inputEmail" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Mật khẩu</label>
                    <input type="password" name="password" id="inputPassword" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="inputPhone" class="form-label">Số điện thoại</label>
                    <input type="tel" name="phone" id="inputPhone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="inputAddress" class="form-label">Địa chỉ</label>
                    <textarea name="address" id="inputAddress" class="form-control" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2">Đăng ký</button>
            </form>

            <p class="text-center mt-3 mb-0">
                <a href="login.php">Đã có tài khoản? Đăng nhập ngay</a>
            </p>
        </div>
    </div>

    <script>
        (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>

</html>