<?php
$message = $_SESSION['message'] ?? null;
$type = $_SESSION['type'] ?? null;
unset($_SESSION['message'], $_SESSION['type']);
?>
<div class="container py-5 position-relative">
    <h2 class="text-center mb-4 text-primary">Danh sách sản phẩm</h2>

    <div class="row justify-content-center mb-2">
        <div class="col-md-6 position-relative">
            <input type="text" id="productSearchInput" class="form-control" placeholder="🔍 Tìm kiếm sản phẩm...">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6 offset-md-3">
            <!-- Nút mở bộ lọc -->
            <button class="btn btn-outline-secondary mb-2" type="button" id="toggleFilterBtn">
                <i class="bi bi-filter"></i> Lọc theo danh mục
            </button>

            <!-- Vùng chứa các checkbox lọc -->
            <div id="categoryFilterWrapper" style="display: none;">
                <div id="categoryFilter" class="d-flex flex-column gap-2 border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                    <?php
                    $category_names = [];
                    foreach ($product as $p) {
                        $category = htmlspecialchars($p['category_name']);
                        $category_names[$category] = true;
                    }

                    foreach (array_keys($category_names) as $cat_name) {
                        $cat_id = md5($cat_name);
                        echo "
                    <div class='form-check'>
                        <input class='form-check-input category-checkbox' type='checkbox' value='$cat_name' id='cat-$cat_id'>
                        <label class='form-check-label' for='cat-$cat_id'>
                            $cat_name
                        </label>
                    </div>
                    ";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


    <!-- Nút Prev -->
    <button class="btn btn-outline-secondary position-absolute top-50 start-0 translate-middle-y z-2" id="prevBtn">
        ←
    </button>

    <!-- Nút Next -->
    <button class="btn btn-outline-secondary position-absolute top-50 end-0 translate-middle-y z-2" id="nextBtn">
        →
    </button>

    <!-- Thanh trượt sản phẩm -->
    <div id="sliderContainer" class="d-flex overflow-hidden px-5" style="scroll-behavior: smooth;">
        <?php
        $grouped_products = [];
        foreach ($product as $p) {
            $product_id = $p['product_id'];
            if (!isset($grouped_products[$product_id])) {
                $grouped_products[$product_id] = [
                    'info' => $p,
                    'sizes' => []
                ];
            }
            $grouped_products[$product_id]['sizes'][] = [
                'size_name' => $p['size_name'],
                'size_price' => $p['size_price']
            ];
        }

        foreach ($grouped_products as $product_id => $data):
            $product_info = $data['info'];
            $sizes = $data['sizes'];
        ?>
            <div class="product-card flex-shrink-0 p-2" style="width: 25%;">
                <div class="card shadow h-100 d-flex flex-column">
                    <img src="/Du_an_1/Assets/image/products/<?= htmlspecialchars($product_info['product_image']) ?>"
                        class="card-img-top product-img-modal-trigger" alt="Ảnh sản phẩm"
                        style="cursor: pointer"
                        data-id="<?= $product_id ?>"
                        data-name="<?= htmlspecialchars($product_info['product_name']) ?>"
                        data-desc="<?= htmlspecialchars($product_info['product_description']) ?>"
                        data-img="/Du_an_1/Assets/image/products/<?= htmlspecialchars($product_info['product_image']) ?>"
                        data-sizes='<?= json_encode($sizes) ?>'>
                    <div class="card-body flex-grow-1 d-flex flex-column">
                        <h5 class="card-title fw-bold"><?= htmlspecialchars($product_info['product_name']); ?></h5>
                        <p class="card-text d-none"><?= nl2br(htmlspecialchars($product_info['product_description'])); ?></p>
                        <div class="mt-auto">
                            <p class="fw-bold text-danger mb-2">Giá:
                                <span id="price-<?= $product_id; ?>">
                                    <?= number_format($sizes[0]['size_price'], 0, ',', '.'); ?> VND
                                </span>
                            </p>

                            <p class="card-text text-muted small d-none">Danh mục: <?= htmlspecialchars($product_info['category_name']); ?></p>
                            <p class="mb-1 fw-semibold">Chọn kích thước:</p>
                            <div class="size-row d-flex gap-2 flex-nowrap mb-2" data-product-id="<?= $product_id; ?>">
                                <?php foreach ($sizes as $index => $size): ?>
                                    <span class="size-option px-2 py-1 border rounded text-center
                                        <?= $index === 0 ? 'active-size bg-primary text-white' : 'text-dark bg-light'; ?>"
                                        data-size="<?= htmlspecialchars($size['size_name']); ?>"
                                        data-price="<?= $size['size_price']; ?>">
                                        <?= htmlspecialchars($size['size_name']); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white py-2 d-flex align-items-center justify-content-between gap-2">
                        <?php
                        $buyNowLink = isset($_SESSION['user'])
                            ? "?action=order&id=$product_id&size=" . urlencode($sizes[0]['size_name'])
                            : "../Auth/404.php";
                        $addToCartLink = isset($_SESSION['user'])
                            ? "?action=addToCart&id=$product_id&size=" . urlencode($sizes[0]['size_name'])
                            : "../Auth/404.php";
                        ?>
                        <a href="<?= $buyNowLink ?>" class="buy-now-link flex-grow-1" data-product-id="<?= $product_id; ?>" data-default-size="<?= $sizes[0]['size_name']; ?>">
                            <button class="btn btn-primary w-100">⚡ Mua ngay</button>
                        </a>
                        <a href="<?= $addToCartLink ?>" class="add-to-cart-link" data-product-id="<?= $product_id; ?>" data-default-size="<?= $sizes[0]['size_name']; ?>">
                            <button class="btn btn-outline-primary"><i class="bi bi-cart"></i></button>
                        </a>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg custom-modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body m-2">
                <button type="button" class="btn-close m-2" data-bs-dismiss="modal" aria-label="Đóng"></button>
                <div class="row g-4 align-items-start">
                    <div class="col-md-5">
                        <img id="modalProductImage" src="" class="img-fluid rounded shadow w-100" alt="Ảnh sản phẩm">
                    </div>
                    <div class="col-md-7">
                        <h3 class="modal-title fw-bold" id="productModalLabel"></h3>
                        <p id="modalProductDesc" class="mb-3"></p>
                        <p class="fw-bold text-danger">Giá: <span id="modalProductPrice"></span></p>
                        <!-- ⭐ Đánh giá, review, sold -->
                        <p class="mb-2">
                            ⭐ <span id="modalProductRating" class="me-3"></span>
                            📝 <span id="modalProductReviewCount" class="me-3"></span>
                            🔥 <span id="modalProductSold"></span>
                        </p>
                        <div class="mb-3">
                            <p class="mb-1 fw-semibold">Chọn kích thước:</p>
                            <div id="modalSizeOptions" class="d-flex gap-2 flex-wrap"></div>
                        </div>
                        <div class="alert alert-success py-2 px-3 small mb-0" role="alert">
                            🎁 <strong>Tặng bộ dao dĩa cao cấp</strong><br>
                            🚚 <strong>Miễn phí vận chuyển trong bán kính 5km</strong>
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <a id="modalBuyNow" href="#" class="flex-grow-1">
                                <button class="btn btn-primary w-100">⚡ Mua ngay</button>
                            </a>
                            <a id="modalAddToCart" href="#">
                                <button class="btn btn-outline-primary"><i class="bi bi-cart"></i></button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS -->
<style>
    .size-option {
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.85rem;
        min-width: 60px;
    }

    .size-option:hover {
        background-color: #007bff;
        color: white;
    }

    .active-size {
        background-color: #007bff !important;
        color: white !important;
        font-weight: bold;
    }

    #sliderContainer::-webkit-scrollbar {
        display: none;
    }

    #productSearchInput {
        font-size: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
    }

    @media (min-width: 1000px) {
        .modal-lg.custom-modal-lg {
            max-width: 1000px;
            /* tăng từ 800px lên 950px */
        }
    }

    #modalProductImage {
        max-height: 370px;
        object-fit: cover;
    }

    #productModalLabel {
        color: #4CAF50;
        /* Màu lá mạ */
    }

    .modal-header {
        position: relative;
    }

    .btn-close {
        position: absolute;
        right: 0;
        top: 0;
    }
</style>

<!-- JS -->
<script>
    <?php if (isset($message)): ?>

        Swal.fire({
            icon: '<?php echo $type; ?>',
            title: '<?php echo $message; ?>',
            showConfirmButton: true,
            position: 'top',
            toast: true,
            timer: 3000,
            timerProgressBar: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        });
    <?php endif; ?>

    const slider = document.getElementById('sliderContainer');
    const scrollAmount = slider.querySelector('.product-card')?.offsetWidth || 300;

    document.getElementById('nextBtn').addEventListener('click', () => {
        slider.scrollBy({
            left: scrollAmount,
            behavior: 'smooth'
        });
    });

    document.getElementById('prevBtn').addEventListener('click', () => {
        slider.scrollBy({
            left: -scrollAmount,
            behavior: 'smooth'
        });
    });

    document.getElementById('toggleFilterBtn').addEventListener('click', () => {
        const wrapper = document.getElementById('categoryFilterWrapper');
        wrapper.style.display = wrapper.style.display === 'none' ? 'block' : 'none';
    });

    document.querySelectorAll('.size-row').forEach(row => {
        row.addEventListener('click', function(e) {
            if (e.target.classList.contains('size-option')) {
                const selected = e.target;
                const productId = row.getAttribute('data-product-id');
                const price = selected.getAttribute('data-price');
                const size = selected.getAttribute('data-size');

                row.querySelectorAll('.size-option').forEach(opt => opt.classList.remove('active-size', 'bg-primary', 'text-white'));
                selected.classList.add('active-size', 'bg-primary', 'text-white');

                const priceEl = document.getElementById('price-' + productId);
                if (priceEl) {
                    priceEl.innerText = parseInt(price).toLocaleString('vi-VN') + ' VND';
                }

                const buyLink = document.querySelector(`.buy-now-link[data-product-id="${productId}"]`);
                const cartLink = document.querySelector(`.add-to-cart-link[data-product-id="${productId}"]`);

                if (buyLink) buyLink.href = `?action=order&id=${productId}&size=${encodeURIComponent(size)}`;
                if (cartLink) cartLink.href = `?action=addToCart&id=${productId}&size=${encodeURIComponent(size)}`;
            }
        });
    });

    // Modal xử lý
    const modalEl = document.getElementById('productModal');
    const modal = new bootstrap.Modal(modalEl);

    document.querySelectorAll('.product-img-modal-trigger').forEach(img => {
        img.addEventListener('click', () => {
            const id = img.dataset.id;
            const name = img.dataset.name;
            const desc = img.dataset.desc;
            const imageUrl = img.dataset.img;
            const sizes = JSON.parse(img.dataset.sizes);

            // Dữ liệu giả cho đánh giá / review / sold
            const fakeRating = (Math.random() * 0.5 + 4.5).toFixed(1);
            const fakeReview = Math.floor(Math.random() * 100 + 10); // 10 - 109 reviews
            const fakeSold = Math.floor(Math.random() * 500 + 50); // 50 - 549 sold

            document.getElementById('modalProductRating').innerText = fakeRating + ' / 5.0';
            document.getElementById('modalProductReviewCount').innerText = fakeReview + ' đánh giá';
            document.getElementById('modalProductSold').innerText = fakeSold + ' đã bán';

            // Gán nội dung modal như cũ
            document.getElementById('productModalLabel').innerText = name;
            document.getElementById('modalProductImage').src = imageUrl;
            document.getElementById('modalProductDesc').innerText = desc;

            const sizeContainer = document.getElementById('modalSizeOptions');
            sizeContainer.innerHTML = '';

            let selectedSize = sizes[0];
            document.getElementById('modalProductPrice').innerText = Number(selectedSize.size_price).toLocaleString('vi-VN') + ' VND';
            <?php if (isset($_SESSION['user'])): ?>
                document.getElementById('modalBuyNow').href = `?action=order&id=${id}&size=${encodeURIComponent(selectedSize.size_name)}`;
                document.getElementById('modalAddToCart').href = `?action=addToCart&id=${id}&size=${encodeURIComponent(selectedSize.size_name)}`;
            <?php else: ?>
                document.getElementById('modalBuyNow').href = `../Auth/404.php`;
                document.getElementById('modalAddToCart').href = `../Auth/404.php`;
            <?php endif; ?>


            sizes.forEach((size, index) => {
                const span = document.createElement('span');
                span.className = 'size-option px-2 py-1 border rounded text-center' + (index === 0 ? ' active-size bg-primary text-white' : ' bg-light');
                span.innerText = size.size_name;
                span.dataset.price = size.size_price;
                span.dataset.name = size.size_name;

                span.addEventListener('click', () => {
                    sizeContainer.querySelectorAll('.size-option').forEach(s => s.classList.remove('active-size', 'bg-primary', 'text-white'));
                    span.classList.add('active-size', 'bg-primary', 'text-white');

                    document.getElementById('modalProductPrice').innerText = Number(size.size_price).toLocaleString('vi-VN') + ' VND';
                    document.getElementById('modalBuyNow').href = `?action=order&id=${id}&size=${encodeURIComponent(size.size_name)}`;
                    document.getElementById('modalAddToCart').href = `?action=addToCart&id=${id}&size=${encodeURIComponent(size.size_name)}`;
                });

                sizeContainer.appendChild(span);
            });

            modal.show();
        });
    });

    function filterProducts() {
        const keyword = document.getElementById('productSearchInput').value.toLowerCase();
        const checkedCategories = Array.from(document.querySelectorAll('.category-checkbox:checked')).map(cb => cb.value.toLowerCase());
        const products = document.querySelectorAll('.product-card');

        products.forEach(card => {
            const title = card.querySelector('.card-title').innerText.toLowerCase();
            const desc = card.querySelector('.card-text').innerText.toLowerCase();
            const category = card.querySelector('.card-text.text-muted')?.innerText.toLowerCase() || "";

            const matchesKeyword = title.includes(keyword) || desc.includes(keyword);
            const matchesCategory = checkedCategories.length === 0 || checkedCategories.some(cat => category.includes(cat));

            card.style.display = matchesKeyword && matchesCategory ? 'block' : 'none';
        });
    }

    document.getElementById('productSearchInput').addEventListener('input', filterProducts);
    document.querySelectorAll('.category-checkbox').forEach(cb => cb.addEventListener('change', filterProducts));
</script>