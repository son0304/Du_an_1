<div class="container-fluid">
    <div class="text-center mb-4">
        <h1 class="h3 text-gray-800">Danh sách liên hệ của khách hàng</h1>
    </div>

    <div class="mx-auto mt-4 p-3 border rounded" style="max-width: 600px;">
        <?php foreach ($contacts as $contact) : ?>
            <div class="d-flex align-items-center justify-content-between mb-3 p-2 rounded hover-shadow" style="transition: background-color 0.2s;">
                <a href="?action=updateContact&id=<?= $contact['id']; ?>" class="d-flex align-items-center text-decoration-none text-dark flex-grow-1 me-2">
                    <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center me-3"
                        style="width: 40px; height: 40px;">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="chat-bubble p-2 bg-light rounded">
                        <strong><?= $contact['fullname']; ?></strong>
                    </div>
                </a>
                <?php
                $status = $contact['status'];
                $badgeClass = 'badge bg-secondary';
                if ($status === 'Chờ xác nhận') {
                    $badgeClass = 'badge bg-warning text-dark';
                } elseif ($status === 'Đã xác nhận') {
                    $badgeClass = 'badge bg-success';
                }
                ?>
                <span class="<?= $badgeClass ?>" style="font-size: 0.85rem;">
                    <?= $status ?>
                </span>
            </div>
        <?php endforeach; ?>
    </div>
</div>