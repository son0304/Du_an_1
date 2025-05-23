<div class="container-fluid">
    <div class="d-flex align-items-start mb-4">
        <a href="?action=contacts" class="btn btn-outline-secondary me-3 d-flex align-items-center" style="height: 70px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center me-3"
            style="width: 70px; height: 70px;">
            <i class="fas fa-user fa-lg"></i>
        </div>
        <div>
            <h1 class="h3 text-gray-800 mb-1"><?= $contacts['fullname'] ?></h1>
            <span class="badge <?= $_SESSION['user']['role'] ? 'bg-warning' : 'bg-success' ?>">
                <?= $_SESSION['user']['role'] ? 'member' : null ?>
            </span>
        </div>
        
        <div class="ms-auto">
            <?php
            $status = $contacts['status'];
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
    </div>

    <?php if (($contacts['status'] ?? '') !== 'Đã xác nhận'): ?>
        <div class="mb-4">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= htmlspecialchars($contacts['id']) ?>">
                <button type="submit" name="status" value="Đã xác nhận" class="btn btn-success">
                    Xác nhận
                </button>
            </form>
        </div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-body">
            <p><strong>Tiêu đề:</strong> <?= htmlspecialchars($contacts['title'] ?? '') ?></p>
            <p><strong>Yêu cầu:</strong><br><?= nl2br(htmlspecialchars($contacts['description'] ?? '')) ?></p>
        </div>
    </div>
</div>
