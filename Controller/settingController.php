<?php
require_once __DIR__ . '/../Model/settingModel.php';

class SettingController
{
    private $settingModel;

    public function __construct($db)
    {
        $this->settingModel = new SettingModel($db);
    }

    // Hiển thị danh sách cài đặt
    public function listSetting()
    {
        $settings = $this->settingModel->listSettingModel();
        include_once __DIR__ . '/../View/Admin/settings/list.php';
    }

    // Cập nhật cài đặt
    public function updateSetting()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
        $id   = $_GET['id'];
        $set1 = $_POST['set1'];
        $set2 = $_POST['set2'];
        $set3 = $_POST['set3'];
        $set4 = $_POST['set4'];
        $set5 = $_POST['set5'];

        $result = $this->settingModel->updateSettingModel($id, $set1, $set2, $set3, $set4, $set5);

        if ($result) {
            header("Location: dashboard.php?action=settings");
            exit();
        } else {
            echo "Cập nhật thất bại.";
        }
    }

    // ✅ Load dữ liệu cũ để hiển thị ra form
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $settings = $this->settingModel->getSettingById($id); // ← đảm bảo có hàm này
    }

    include_once __DIR__ . '/../View/Admin/settings/update.php';
}


    // Xóa cài đặt
    public function deleteSetting()
    {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "Không tìm thấy ID cần xóa";
            return;
        }

        $id = $_GET['id'];

        if ($this->settingModel->deleteSettingModel($id)) {
            header("Location: dashboard.php?action=settings");
            exit();
        } else {
            echo "Xóa thất bại.";
        }
    }
}
