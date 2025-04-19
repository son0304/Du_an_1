<?php
require_once __DIR__ . '/../../Controller/auth.php';
require_once __DIR__ . '/../../Config/config.php';

$auth = new AuthController($conn);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action_type'] === 'login') {
        $errors = $auth->login();
    } elseif ($_POST['action_type'] === 'register') {
        $errors = $auth->register();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sweet Cake - Login & Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="icon" type="image/png" href="../../Assets/image/products/Sweet Cake.jpg" />
    <style>
        body {
            background-color: #f2f2f7;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-container {
            width: 100%;
            max-width: 1000px;
            height: 600px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            display: flex;
            position: relative;
            transition: all 0.8s ease;
        }

        .panel {
            width: 50%;
            height: 100%;
            position: absolute;
            top: 0;
            transition: transform 0.8s ease;
            padding: 3rem;
            overflow-y: auto;
        }

        .image-panel {
            background: url('../../Assets/image/products/Sweet Cake.jpg') no-repeat center center / cover;
            left: 0;
            z-index: 2;
            border-radius: 16px 0 0 16px;
        }

        .form-login,
        .form-register {
            background-color: #fff;
            z-index: 1;
        }

        .form-login {
            right: 0;
        }

        .form-register {
            left: -50%;
        }

        .form-title {
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            font-size: 1rem;
        }

        .form-check-label {
            font-size: 0.95rem;
        }

        .btn {
            border-radius: 8px;
            padding: 10px;
            font-size: 1.05rem;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0062cc;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .auth-switch {
            margin-top: 1.2rem;
            text-align: center;
            font-size: 0.95rem;
        }

        .auth-switch a {
            color: #007bff;
            text-decoration: none;
        }

        .auth-switch a:hover {
            text-decoration: underline;
        }

        .form-container.active .image-panel {
            transform: translateX(100%);
        }

        .form-container.active .form-register {
            transform: translateX(100%);
        }

        .form-container.active .form-login {
            transform: translateX(100%);
        }
    </style>
</head>

<body>

    <div class="form-container <?= (isset($_POST['action_type']) && $_POST['action_type'] === 'register') ? 'active' : '' ?>" id="authContainer">
        <!-- Image -->
        <div class="panel image-panel"></div>

        <!-- Login Form -->
        <div class="panel form-login">
            <h3 class="form-title">Đăng nhập</h3>
            <?php if (!empty($error) && $_POST['action_type'] === 'login') : ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <form action="" method="POST" novalidate>
                <input type="hidden" name="action_type" value="login">
                <div class="mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Tên đăng nhập"
                        value="<?= isset($_POST['action_type']) && $_POST['action_type'] === 'login' ? htmlspecialchars($_POST['name'] ?? '') : '' ?>" required />
                    <?php if (isset($errors['name'])): ?>
                        <span class="text-danger"><?= $errors['name'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required />
                    <?php if (isset($errors['password'])): ?>
                        <span class="text-danger"><?= $errors['password'] ?></span>
                    <?php endif; ?>
                </div>
                <?php if (isset($errors['login'])): ?>
                    <div class="alert alert-danger"><?= $errors['login'] ?></div>
                <?php endif; ?>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe" />
                    <label class="form-check-label" for="rememberMe">Ghi nhớ đăng nhập</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                <div class="auth-switch">
                    <span>Chưa có tài khoản? <a href="#" id="showRegister">Đăng ký</a></span>
                </div>
            </form>
        </div>

        <!-- Register Form -->
        <div class="panel form-register">
            <h3 class="form-title">Đăng ký tài khoản</h3>
            <?php if (!empty($error) && $_POST['action_type'] === 'register') : ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <form action="" method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="action_type" value="register">
                <div class="mb-2">
                    <input type="text" name="name" class="form-control" placeholder="Tên đăng nhập"
                        value="<?= (isset($_POST['action_type']) && $_POST['action_type'] === 'register') ? htmlspecialchars($_POST['name'] ?? '') : '' ?>" required />
                    <?php if (isset($errors['name'])): ?>
                        <span class="text-danger"><?= $errors['name'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="mb-2">
                    <input type="email" name="email" class="form-control" placeholder="Email"
                        value="<?= (isset($_POST['action_type']) && $_POST['action_type'] === 'register') ? htmlspecialchars($_POST['email'] ?? '') : '' ?>" required />
                    <?php if (isset($errors['email'])): ?>
                        <span class="text-danger"><?= $errors['email'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="mb-2">
                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required />
                    <?php if (isset($errors['password'])): ?>
                        <span class="text-danger"><?= $errors['password'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="mb-2">
                    <input type="tel" name="phone" class="form-control" placeholder="Số điện thoại"
                        value="<?= (isset($_POST['action_type']) && $_POST['action_type'] === 'register') ? htmlspecialchars($_POST['phone'] ?? '') : '' ?>" required />
                    <?php if (isset($errors['phone'])): ?>
                        <span class="text-danger"><?= $errors['phone'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-map-marker-alt"></i> Địa chỉ
                    </label>
                    <textarea id="address" name="address" class="form-control" rows="2" placeholder="Địa chỉ" required><?= (isset($_POST['action_type']) && $_POST['action_type'] === 'register') ? htmlspecialchars($_POST['address'] ?? '') : '' ?></textarea>
                    <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="getCurrentLocation()">
                        <i class="fas fa-location-arrow"></i> Vị trí hiện tại
                    </button>
                    <?php if (isset($errors['address'])): ?>
                        <span class="text-danger"><?= $errors['address'] ?></span>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-success w-100">Đăng ký</button>
                <div class="auth-switch">
                    <span>Đã có tài khoản? <a href="#" id="backToLogin">Đăng nhập</a></span>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('showRegister').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('authContainer').classList.add('active');
        });

        document.getElementById('backToLogin').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('authContainer').classList.remove('active');
        });

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
    <script>
        function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(async function(position) {
                        const lat = position.coords.latitude;
                        const lon = position.coords.longitude;

                        try {
                            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`);
                            const data = await response.json();

                            if (data && data.display_name) {
                                document.getElementById('address').value = data.display_name;
                            } else {
                                alert('Không thể lấy địa chỉ từ vị trí hiện tại.');
                            }
                        } catch (error) {
                            alert('Lỗi khi gọi Nominatim: ' + error.message);
                        }
                    },
                    function(error) {
                        alert('Lỗi khi lấy vị trí: ' + error.message);
                    });
            } else {
                alert('Trình duyệt không hỗ trợ lấy vị trí!');
            }
        }
    </script>
</body>

</html>