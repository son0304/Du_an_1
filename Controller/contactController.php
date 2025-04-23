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
        $id_user = $_SESSION['user']['id'];
        $id_contact = $this->contactModel->getContactByIdUser($id_user)['id'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $title = $_POST['title'];
            $description = $_POST['description'];

            $this->contactModel->addContact($id_user, $id_contact, $fullname, $email, $phone, $title, $description);

            header("Location: /Du_an_1/View/Client/index.php?action=contact");
            exit();
        }

        include_once __DIR__ . '/../View/Client/contacts/contact.php';
    }

    public function updateContactStatus()
    {
        $id = $_GET['id'] ?? null;

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
            $status = $_POST['status'];

            $result = $this->contactModel->updateContactStatus($id, $status);
        }
        if (isset($id)) {
            // $id = $_GET['id'];
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
