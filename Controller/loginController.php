<?php
require_once __DIR__ . '/../Model/loginModel.php';

class LoginController {
    private $loginModel;

    public function __construct($db) {
        session_start();
        $this->loginModel = new LoginModel($db);
    }

    public function form(){
        include_once __DIR__ . '/../Auth/login.php';
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $_SESSION['error'] = "Vui lòng nhập đầy đủ email và mật khẩu!";
                header("Location: index.php?action=form");
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Email không đúng định dạng!";
                header("Location: index.php?action=form");
                exit();
            }

            $user = $this->loginModel->loginModel($email, $password);

            if ($user) {
                $_SESSION['user'] = [
                    'email' => $user['email'],
                    'role' => $user['role']
                ];

                // Điều hướng dựa trên vai trò
                if ($user['role'] == 0) {
                    header("Location: /Du_an_1/View/Admin/dashboard.php"); // Điều hướng đến trang quản trị
                } else {
                    header("Location:/Du_an_1/View/Client/index.php"); // Điều hướng đến trang chính của người dùng
                }
                exit();
            } else {
                $_SESSION['error'] = "Email hoặc mật khẩu không chính xác!";
                header("Location: index.php?action=form");
                exit();
            }
        }
        
        header("Location: index.php?action=form");
        exit();
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?action=form");
        exit();
    }
}