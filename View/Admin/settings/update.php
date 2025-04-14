<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Cập nhật Setting</h1>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">Chỉnh sửa thông tin Setting</h6>
        </div>

        <div class="card-body">
            <form action="" method="post" class="row g-3">
                <div class="col-md-6">
                    <label for="set1" class="form-label">Setting 1</label>
                    <input type="text" class="form-control" id="set1" name="set1" value="<?= htmlspecialchars($settings['set1'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="set2" class="form-label">Setting 2</label>
                    <input type="text" class="form-control" id="set2" name="set2" value="<?= htmlspecialchars($settings['set2'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="set3" class="form-label">Setting 3</label>
                    <input type="text" class="form-control" id="set3" name="set3" value="<?= htmlspecialchars($settings['set3'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="set4" class="form-label">Setting 4</label>
                    <input type="text" class="form-control" id="set4" name="set4" value="<?= htmlspecialchars($settings['set4'] ?? '') ?>" required>
                </div>
                <div class="col-md-12">
                    <label for="set5" class="form-label">Setting 5</label>
                    <input type="text" class="form-control" id="set5" name="set5" value="<?= htmlspecialchars($settings['set5'] ?? '') ?>" required>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    <a href="dashboard.php?action=settings" class="btn btn-secondary ms-2">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</div>
