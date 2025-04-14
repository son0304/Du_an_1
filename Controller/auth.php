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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();
            $name = $_POST['name'];
            $password = $_POST['password'];

            $user = $this->authModel->login($name, $password);

            if ($user) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'role' => $user['role']
                ];

                if ($user['role'] == 1) {
                    header("Location: " . BASE_URL . "View/Admin/dashboard.php");
                } else {
                    header("Location: " . BASE_URL . "View/Client/index.php");
                }
                exit();
            } else {
                $_SESSION['error'] = "Tên đăng nhập hoặc mật khẩu không đúng!";
                header("Location: ".BASE_URL . "View/Auth/login.php");
                exit();
            }
        }
    }



    public function logout()
    {
        session_destroy();
        header("Location: ".BASE_URL . "View/Auth/login.php");
        exit();
    }
}
