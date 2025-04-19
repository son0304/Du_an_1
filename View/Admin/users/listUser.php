<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Người dùng</h1>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">Danh sách người dùng</h6>
            <a href="dashboard.php?action=createUser" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Thêm mới
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Địa chỉ</th>
                            <th>Quyền hạn</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user as $row): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= htmlspecialchars($row['phone']) ?></td>
                                <td><?= $row['address'] ?></td>
                                <td>
                                    <?php if ($row['role'] == 1): ?>
                                        Admin
                                    <?php else: ?>
                                        User
                                    <?php endif; ?>
                                </td>

                                <td>

                                    <?php

                                    if ($row['role'] == 1) {
                                      
                                    } else {
                                        echo '<a href="dashboard.php?action=updateUser&id=' . $row['id'] . '" class="btn btn-warning mx-2"><i class="fas fa-edit"></i></a>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>