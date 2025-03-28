<?php
<<<<<<< HEAD
require_once __DIR__ . '/../Model/userModel.php';
=======
require_once __DIR__ . '/../Model/userModel.php' ;
>>>>>>> 294d0ce5651973c99dc7a54f79b0f0f9c3bc8737

class UserController
{
    private $userModel;
<<<<<<< HEAD

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
=======
    public function __construct($db) {
      $this->userModel = new UserModel($db);
    }
    public function listUser() {
        // Lấy danh sách người dùng từ model
        $users = $this->userModel->listUserModel();
        include_once __DIR__ . '/../View/Admin/user/listUser.php';
    }
    public function formEdit($id) {
        // Lấy thông tin người dùng theo ID
        $user = $this->userModel->getUserById($id); 

        // Bao gồm view chỉnh sửa
        include_once __DIR__ . '/../View/Admin/user/editUser.php'; 
    }

    // Phương thức để cập nhật thông tin người dùng
    public function editUser () {
        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $address = $_POST['address'] ?? '';
        

        // Kiểm tra dữ liệu và cập nhật
        if ($id && $name && $email) {
            $this->userModel->updateUser($id,$name,$email,$phone,$address); // Giả sử bạn có phương thức này trong UserModel
            header("Location: dashboard.php?action=users");
            exit();
        } else {
            $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin.";
            header("Location: dashboard.php?action=form-edit&id=".$id);
            exit();
        }
    }
    public function deleteUser () {
        $id = $_GET['id'] ?? null;
    
        if ($id) {
            // Gọi phương thức xóa từ UserModel
            if ($this->userModel->deleteUser($id)) {
                $_SESSION['success'] = "Người dùng đã được xóa thành công.";
            } else {
                $_SESSION['error'] = "Không thể xóa người dùng. Vui lòng thử lại.";
            }
        } else {
            $_SESSION['error'] = "ID người dùng không hợp lệ.";
        }
    
        // Chuyển hướng về danh sách người dùng
>>>>>>> 294d0ce5651973c99dc7a54f79b0f0f9c3bc8737
        header("Location: dashboard.php?action=users");
        exit();
    }
}
