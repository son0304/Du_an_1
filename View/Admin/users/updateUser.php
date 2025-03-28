<?php
// Đảm bảo biến $user chứa dữ liệu cần cập nhật trước khi render form
if (!isset($user)) {
    echo "<p class='text-danger'>Không tìm thấy thông tin người dùng!</p>";
    exit();
}
?>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="card shadow-lg p-4" style="max-width: 600px; width: 100%;">
            <h4 class="text-center text-warning mb-3">Cập Nhật Người Dùng</h4>
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-user"></i> Họ và Tên</label>
                        <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-lock"></i> Mật khẩu (để trống nếu không đổi)</label>
                        <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu mới">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-phone"></i> Số điện thoại</label>
                        <input type="tel" class="form-control" name="phone" value="<?= $user['phone'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-map-marker-alt"></i> Địa chỉ</label>
                        <input type="text" class="form-control" name="address" value="<?= $user['address'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-user-shield"></i> Quyền hạn</label>
                        <select class="form-select" name="role" required>
                            <option value="1" <?= $user['role'] == 1 ? 'selected' : '' ?>>Admin</option>
                            <option value="0" <?= $user['role'] == 0 ? 'selected' : '' ?>>User</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning w-100">
                    <i class="fas fa-edit"></i> Cập Nhật Người Dùng
                </button>
            </form>
        </div>
    </div>
</body>
