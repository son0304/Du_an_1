<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Đăng ký</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Đăng ký tài khoản</h2>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']); // Xóa thông báo lỗi sau khi hiển thị
                ?>
            </div>
        <?php endif; ?>

        <form action="index.php?action=register" method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="inputName" class="form-label">Họ và tên</label>
                <input type="text" name="name" class="form-control" id="inputName" 
                       value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" required>
            </div>

            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail" 
                       value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
            </div>

            <div class="mb-3">
                <label for="inputPassword" class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control" id="inputPassword" required>
            </div>

            <div class="mb-3">
                <label for="inputPhone" class="form-label">Số điện thoại</label>
                <input type="tel" name="phone" class="form-control" id="inputPhone" 
                       value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '' ?>" required>
            </div>

            <div class="mb-3">
                <label for="inputAddress" class="form-label">Địa chỉ</label>
                <textarea name="address" class="form-control" id="inputAddress" rows="3" required><?= isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '' ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Đăng ký</button>
        </form>
        
        <p class="mt-3">Đã có tài khoản? <a href="index.php?action=form">Đăng nhập ngay</a></p>
    </div>

    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
    </script>
</body>
</html>