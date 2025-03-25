<?php
session_start();

if (isset($_SESSION['user'])) {
    echo "<h2>Thông Tin Người Dùng</h2>";
    echo "<p>Email: " . ($_SESSION['user']['email']) . "</p>";
    echo "<p>Vai trò: " . ($_SESSION['user']['role'] == 0 ? 'Admin' : 'Người dùng') . "</p>";
    echo "<p>Địa chỉ: " . ($_SESSION['user']['address']) . "</p>";
    echo "<p>Số điện thoại: " . ($_SESSION['user']['phone']) . "</p>";
    
    echo "<h3>Debug - Toàn bộ thông tin session:</h3>";
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
} else {
    echo "<h2>Chưa đăng nhập</h2>";
    echo "<p>Vui lòng đăng nhập để xem thông tin</p>";
}
