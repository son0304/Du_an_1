<?php
require_once __DIR__ . '/../Model/authModel.php';
class AuthController
{
    private $authModel;

    public function __construct($db)
    {
        $this->authModel = new AuthModel($db);
    }

    public function login()
    {
        session_start();
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $password = $_POST['password'];

            if (empty($name)) $errors['name'] = "Vui lòng nhập tên đăng nhập!";
            if (empty($password)) $errors['password'] = "Vui lòng nhập mật khẩu!";

            if (!$errors) {
                $user = $this->authModel->login($name, $password);

                if ($user) {
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'role' => $user['role']
                    ];
                    $redirect = $user['role'] == 1
                        ? BASE_URL . "View/Admin/dashboard.php"
                        : BASE_URL . "View/Client/index.php";
                    header("Location: $redirect");
                    exit();
                } else {
                    $errors['login'] = "Tên đăng nhập hoặc mật khẩu không đúng!";
                }
            }
        }

        return $errors;
    }

    public function register()
    {
        session_start();
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $phone = trim($_POST['phone']);
            $address = trim($_POST['address']);

            // Validate từng trường
            if (empty($name)) $errors['name'] = "Vui lòng nhập tên đăng nhập!";
            if (empty($email)) $errors['email'] = "Vui lòng nhập email!";
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = "Email không đúng định dạng!";

            if (empty($password)) $errors['password'] = "Vui lòng nhập mật khẩu!";
            elseif (strlen($password) < 6) $errors['password'] = "Mật khẩu phải có ít nhất 6 ký tự!";

            if (empty($phone)) $errors['phone'] = "Vui lòng nhập số điện thoại!";
            elseif (!preg_match('/^(0|\+84)[3|5|7|8|9][0-9]{8}$/', $phone)) $errors['phone'] = "Số điện thoại không hợp lệ!";

            if (empty($address)) $errors['address'] = "Vui lòng nhập địa chỉ!";

            if ($this->authModel->isNameExists($name)) {
                $errors['name'] = "Tên người dùng đã tồn tại!";
            }

            if (!$errors) {
                if ($this->authModel->register($name, $email, $password, $phone, $address)) {
                    header("Location: /Du_an_1/View/Auth/login.php");
                    exit();
                } else {
                    $errors['email'] = "Email đã tồn tại!";
                }
            }
        }
        
        return $errors;
    }

    public function logout()
    {
        session_destroy();
        header("Location: " . BASE_URL . "View/Auth/login.php");
        exit();
    }
}
