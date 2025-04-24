<div class="container-fluid">
    <div class="text-center mb-4">
        <h1 class="h3 text-gray-800">Danh sách liên hệ của khách hàng</h1>
    </div>

    <!-- Ô tìm kiếm -->
    <div class="mx-auto mb-3" style="max-width: 600px;">
        <div class="row g-2">
            <div class="col-7">
                <input type="text" id="searchInput" class="form-control" placeholder="Tìm theo tên...">
            </div>
            <div class="col-5">
                <select id="statusFilter" class="form-select">
                    <option value="">Tất cả trạng thái</option>
                    <option value="Chờ xác nhận">Chờ xác nhận</option>
                    <option value="Đã xác nhận">Đã xác nhận</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Danh sách liên hệ -->
    <div class="mx-auto mt-2 p-3 border rounded" style="max-width: 600px;" id="contactList">
        <?php foreach ($contacts as $contact) : ?>
            <div class="contact-item d-flex align-items-center justify-content-between mb-3 p-2 rounded hover-shadow"
                style="transition: background-color 0.2s;">
                <a href="?action=updateContact&id=<?= $contact['id']; ?>"
                    class="d-flex align-items-center text-decoration-none text-dark flex-grow-1 me-2">
                    <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center me-3"
                        style="width: 40px; height: 40px;">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="chat-bubble p-2 bg-light rounded">
                        <strong class="contact-name"><?= htmlspecialchars($contact['fullname']); ?></strong>
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
                    <?= htmlspecialchars($status); ?>
                </span>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const contactItems = document.querySelectorAll('#contactList .contact-item');

        function filterContacts() {
            const keyword = searchInput.value.toLowerCase();
            const selectedStatus = statusFilter.value.toLowerCase();

            contactItems.forEach(function(item) {
                const name = item.querySelector('.contact-name').textContent.toLowerCase();
                const status = item.querySelector('span')?.textContent.toLowerCase().trim() || '';

                const matchesKeyword = name.includes(keyword);
                const matchesStatus = !selectedStatus || status === selectedStatus;

                if (matchesKeyword && matchesStatus) {
                    item.classList.remove('d-none');
                    item.classList.add('d-flex');
                } else {
                    item.classList.add('d-none');
                    item.classList.remove('d-flex');
                }
            });
        }

        searchInput.addEventListener('input', filterContacts);
        statusFilter.addEventListener('change', filterContacts);
    });
</script>