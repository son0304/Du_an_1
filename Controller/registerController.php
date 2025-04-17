<?php
require_once __DIR__ . '/../Model/registerModel.php';

class RegisterController
{
    private $registerModel;

    public function __construct($db)
    {
        $this->registerModel = new RegisterModel($db);
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu từ form
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            // Kiểm tra các trường bắt buộc
            if (empty($name) || empty($email) || empty($password) || empty($phone) || empty($address)) {
                $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin!";
                header("Location: /Du_an_1/View/Auth/register.php");
                exit();
            }

            // Kiểm tra định dạng email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Email không đúng định dạng!";
                header("Location: /Du_an_1/View/Auth/register.php");
                exit();
            }

            // Kiểm tra số điện thoại Việt Nam
            if (!preg_match('/^(0|\+84)[3|5|7|8|9][0-9]{8}$/', $phone)) {
                $_SESSION['error'] = "Số điện thoại không hợp lệ!";
                header("Location: /Du_an_1/View/Auth/register.php");
                exit();
            }

            // Kiểm tra độ dài mật khẩu
            if (strlen($password) < 6) {
                $_SESSION['error'] = "Mật khẩu phải có ít nhất 6 ký tự!";
                header("Location: /Du_an_1/View/Auth/register.php");
                exit();
            }
            // if ($this->registerModel->isNameExists($name)) {
            //     $_SESSION['error'] = "Tên người dùng đã tồn tại!";
            //     header("Location: /Du_an_1/View/Auth/register.php");
            //     exit();
            // }

            // Thực hiện đăng ký
            $result = $this->registerModel->registerModel($name, $email, $password, $phone, $address);

            if ($result) {
                $_SESSION['success'] = "Đăng ký thành công! Vui lòng đăng nhập.";
                header("Location: /Du_an_1/View/Auth/login.php");
                // Trang đăng nhập
                exit();
            } else {
                $_SESSION['error'] = "Email đã tồn tại!";
                header("Location: /Du_an_1/View/Auth/register.php");
                exit();
            }
        }
        include_once __DIR__ . '/../View/Auth/register.php';
    }
}
