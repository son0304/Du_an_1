>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="card shadow-lg p-4" style="max-width: 600px; width: 100%;">
            <h4 class="text-center text-primary mb-3">Thêm Người Dùng</h4>
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-user"></i> Họ và Tên</label>
                        <input type="text" class="form-control" name="name" placeholder="Nhập họ tên" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Nhập email" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-lock"></i> Mật khẩu</label>
                        <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-phone"></i> Số điện thoại</label>
                        <input type="tel" class="form-control" name="phone" placeholder="Nhập số điện thoại" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label"><i class="fas fa-map-marker-alt"></i> Địa chỉ</label>
                        <input type="text" class="form-control" name="address" placeholder="Nhập địa chỉ" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="fas fa-user-shield"></i> Quyền hạn</label>
                        <select class="form-select" name="role" required>
                            <option value="1">Admin</option>
                            <option value="0">User</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-plus-circle"></i> Thêm Người Dùng
                </button>
            </form>
        </div>
    </div>

   
