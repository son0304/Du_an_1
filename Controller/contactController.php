<?php

require_once __DIR__ . '/../Model/contactModel.php';

class ContactController
{
    private $contactModel;

    public function __construct($db)
    {
        $this->contactModel = new ContactModel($db);
    }

    public function viewContact()
    {
        $contacts = $this->contactModel->getContact();
        include_once __DIR__ . '/../View/Admin/contacts/listContact.php';
    }

    public function addContact()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Hiển thị form contact (GET hoặc lần đầu truy cập)
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            include_once __DIR__ . '/../View/Client/contacts/contact.php';
            return;
        }

        // Người dùng bấm GỬI => kiểm tra đăng nhập
        if (!isset($_SESSION['user'])) {
            // Nếu chưa đăng nhập, chuyển sang trang đăng nhập
            header("Location: /Du_an_1/View/Auth/login.php");
            exit();
        }

        // Đã đăng nhập thì xử lý thêm contact
        $id_user = $_SESSION['user']['id'];
        $contact = $this->contactModel->getContactByIdUser($id_user);
        $id_contact = $contact['id'] ?? null;

        // Lấy dữ liệu từ form
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = 'Chờ xác nhận';

        // Thêm contact
        $this->contactModel->addContact($id_user, $id_contact, $fullname, $email, $phone, $title, $description, $status);

        // Chuyển hướng sau khi gửi thành công
        header("Location: /Du_an_1/View/Client/index.php?action=contact");
        exit();
    }


    public function updateContactStatus()
    {
        $id = $_GET['id'] ?? $_POST['id'] ?? null;

        if ($_SERVER["REQUEST_METHOD"] == "POST" && $id) {
            $status = $_POST['status'];
            $result = $this->contactModel->updateContactStatus($id, $status);
        }

        if ($id) {
            $contacts = $this->contactModel->getContactById($id);
        }

        include_once __DIR__ . '/../View/Admin/contacts/updateContact.php';
    }


    public function deleteContact()
    {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "Không tìm thấy ID cần xóa";
            return;
        }

        $id = $_GET['id'];

        if ($this->contactModel->deleteContact($id)) {
            header("Location: dashboard.php?action=contacts");
            exit();
        } else {
            echo "Xóa thất bại.";
        }
    }
}
