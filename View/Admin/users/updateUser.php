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
                        <label class="form-label">
                            <i class="fas fa-map-marker-alt"></i> Địa chỉ
                            <input type="text" class="form-control" id="address" name="address" value="<?= $user['address'] ?>" required>
                            <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="getCurrentLocation()">
                                <i class="fas fa-location-arrow"></i> Vị trí hiện tại
                            </button>
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning w-100">
                    <i class="fas fa-edit"></i> Cập Nhật Người Dùng
                </button>
            </form>
        </div>
    </div>
</body>
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