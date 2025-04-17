
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Danh sách Settings</h1>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">Settings</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead">
                        <tr>
                            <th>ID</th>
                            <th>Setting 1</th>
                            <th>Setting 2</th>
                            <th>Setting 3</th>
                            <th>Setting 4</th>
                            <th>Setting 5</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($settings as $setting): ?>
                            <tr>
                                <td><?= $setting['id'] ?></td>
                                <td><?= htmlspecialchars($setting['set1']) ?></td>
                                <td><?= htmlspecialchars($setting['set2']) ?></td>
                                <td><?= htmlspecialchars($setting['set3']) ?></td>
                                <td><?= htmlspecialchars($setting['set4']) ?></td>
                                <td><?= htmlspecialchars($setting['set5']) ?></td>
                                <td>
                                    <a href="dashboard.php?action=updateSetting&id=<?= $setting['id'] ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>