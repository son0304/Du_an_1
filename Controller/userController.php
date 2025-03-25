<?php
require_once __DIR__ . '/../Model/userModel.php' ;

class UserController
{
    private $userModel;
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
        header("Location: dashboard.php?action=users");
        exit();
    }
}
