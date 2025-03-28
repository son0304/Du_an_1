<?php
require_once __DIR__ . '/../Model/registerModel.php';

class RegisterController {
    private $registerModel;

    public function __construct($db) {
        // session_start();
        $this->registerModel = new RegisterModel($db);
    }

    public function formRegister() {
        include_once __DIR__ . '/../Auth/register.php';
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';

            // Validate required fields
            if (empty($name) || empty($email) || empty($password) || empty($phone) || empty($address)) {
                $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin!";
                header("Location: index.php?action=registerform");
                exit();
            }

            // Validate email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Email không đúng định dạng!";
                header("Location: index.php?action=registerform");
                exit();
            }

            // Validate phone number (Vietnamese format)
            if (!preg_match('/^(0|\+84)[3|5|7|8|9][0-9]{8}$/', $phone)) {
                $_SESSION['error'] = "Số điện thoại không hợp lệ!";
                header("Location: index.php?action=registerform");
                exit();
            }

            // Validate password strength
            if (strlen($password) < 6) {
                $_SESSION['error'] = "Mật khẩu phải có ít nhất 6 ký tự!";
                header("Location: index.php?action=registerform");
                exit();
            }

            // Attempt to register
            $result = $this->registerModel->registerModel($name, $email, $password, $phone, $address);

            if ($result) {
                $_SESSION['success'] = "Đăng ký thành công! Vui lòng đăng nhập.";
                header("Location: index.php?action=form"); // Redirect to login page
                exit();
            } else {
                $_SESSION['error'] = "Email đã tồn tại ";
                header("Location: index.php?action=registerform");
                exit();
            }
        }

        header("Location: index.php?action=form");
        exit();
    }
}