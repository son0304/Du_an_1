<?php
require_once __DIR__ . '/../Model/userModel.php';

class UserController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new UserModel($db);
    }
    public function listUser()
    {
        $user = $this->userModel->listUserModel();
        include_once __DIR__ . '/../View/Admin/users/listUser.php';
    }
    public function createUser()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $role = $_POST['role'];

            $result = $this->userModel->createUserModel($name, $email, $password, $phone, $address, $role);
            if ($result) {
                echo "Thêm thành công";
                header("Location: dashboard.php?action=users");
                exit();
            } else {
                echo "Thêm người dùng thất bại";
            }
        }
        include_once __DIR__ . '/../View/Admin/users/createUser.php';
    }


    public function updatetUser()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $role = $_POST['role'];

            $result = $this->userModel->updateUserModel($id, $name, $email, $password, $phone, $address, $role);
            if ($result) {
                echo "UPdate thành công";
                header("Location: dashboard.php?action=users");
                exit();
            } else {
                echo "Update người dùng thất bại";
            }
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $user = $this->userModel->getUserById($id);
            include_once __DIR__ . '/../View/Admin/users/updateUser.php';
        }
        include_once __DIR__ . '/../View/Admin/users/updateUser.php';
    }

    public function deleteUser()
    {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "Không tìm thấy id cần xóa";
            return;
        }

        $id = $_GET['id'];

        if ($this->userModel->deleteUserModel($id)) {
            echo "Xóa thành công!";
        } else {
            echo "Lỗi khi xóa người dùng!";
        }
        header("Location: dashboard.php?action=users");
        exit();
    }
}
