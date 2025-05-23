<?php
require_once __DIR__ . '/../../../Model/productModel.php';


$productModel = new ProductModel($conn);

$product = $productModel->listProductModel();

$categories = $productModel->getCategories();
?>

<section class="container my-5">
    <h3 class="text-center text-danger fw-bold mb-4">🎁 Khuyến mãi hot</h3>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="alert alert-warning shadow text-center h-100">
                <h5 class="fw-bold">🎉 Giảm 10%</h5>
                <p>Đặt bánh trước 3 ngày để nhận ưu đãi đặc biệt!</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-info shadow text-center h-100">
                <h5 class="fw-bold">🚚 Miễn phí vận chuyển</h5>
                <p>Áp dụng trong bán kính 5km nội thành.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-success shadow text-center h-100">
                <h5 class="fw-bold">🎈 Combo sinh nhật</h5>
                <p>Tiết kiệm đến 20% khi mua bánh kèm phụ kiện.</p>
            </div>
        </div>
    </div>
</section>
<section class="container my-5">
    <div class="container py-5 position-relative">
        <h3 class="text-center mb-4 text-success">🎂 Bánh được yêu thích</h3>

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
                            <a href="?action=order&id=<?= $product_id; ?>&size=<?= urlencode($sizes[0]['size_name']); ?>"
                                class="buy-now-link flex-grow-1" data-product-id="<?= $product_id; ?>" data-default-size="<?= $sizes[0]['size_name']; ?>">
                                <button class="btn btn-primary w-100">⚡ Mua ngay</button>
                            </a>
                            <a href="?action=addToCart&id=<?= $product_id; ?>&size=<?= urlencode($sizes[0]['size_name']); ?>"
                                class="add-to-cart-link" data-product-id="<?= $product_id; ?>" data-default-size="<?= $sizes[0]['size_name']; ?>">
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
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="productModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4 align-items-start">
                        <div class="col-md-5">
                            <img id="modalProductImage" src="" class="img-fluid rounded shadow w-100" alt="Ảnh sản phẩm">
                        </div>
                        <div class="col-md-7">
                            <p id="modalProductDesc" class="mb-3"></p>
                            <p class="fw-bold text-danger">Giá: <span id="modalProductPrice"></span></p>
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
    </style>

    <!-- JS -->
    <script>
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

                document.getElementById('productModalLabel').innerText = name;
                document.getElementById('modalProductImage').src = imageUrl;
                document.getElementById('modalProductDesc').innerText = desc;

                const sizeContainer = document.getElementById('modalSizeOptions');
                sizeContainer.innerHTML = '';

                let selectedSize = sizes[0];
                document.getElementById('modalProductPrice').innerText = Number(selectedSize.size_price).toLocaleString('vi-VN') + ' VND';
                document.getElementById('modalBuyNow').href = `?action=order&id=${id}&size=${encodeURIComponent(selectedSize.size_name)}`;
                document.getElementById('modalAddToCart').href = `?action=addToCart&id=${id}&size=${encodeURIComponent(selectedSize.size_name)}`;

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
    </script>
</section>
<section class="container my-5">
    <h3 class="text-center text-success fw-bold mb-4">🚚 Chính sách giao hàng & chăm sóc khách hàng</h3>
    <div class="row row-cols-1 row-cols-md-3 g-4 text-center">
        <div class="col">
            <div class="card h-100 shadow-sm p-4">
                <i class="bi bi-truck fs-1 text-primary mb-3"></i>
                <h5 class="fw-bold">Giao hàng nhanh chóng</h5>
                <p>Miễn phí vận chuyển trong bán kính 5km và hỗ trợ giao gấp trong ngày theo yêu cầu.</p>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 shadow-sm p-4">
                <i class="bi bi-shield-check fs-1 text-success mb-3"></i>
                <h5 class="fw-bold">Cam kết chất lượng</h5>
                <p>Bánh làm từ nguyên liệu tươi, không chất bảo quản, đảm bảo an toàn vệ sinh thực phẩm.</p>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 shadow-sm p-4">
                <i class="bi bi-emoji-smile fs-1 text-warning mb-3"></i>
                <h5 class="fw-bold">Hỗ trợ tận tâm</h5>
                <p>Đội ngũ nhân viên sẵn sàng tư vấn và phục vụ khách hàng mọi lúc, mọi nơi.</p>
            </div>
        </div>
    </div>
</section>

<section class="container my-5">
    <h3 class="text-center text-danger fw-bold mb-4">📍 Hệ Thống Cửa Hàng</h3>
    <div class="row row-cols-1 row-cols-md-3 g-4">

        <!-- Cửa hàng 1 -->
        <div class="col">
            <div class="border rounded p-3 shadow-sm h-100">
                <h5 class="fw-bold">Savor Cake Nguyễn Chánh</h5>
                <p><i class="bi bi-clock me-2 text-primary"></i><strong>Giờ mở cửa:</strong> 8h - 22h T2-CN</p>
                <p><i class="bi bi-telephone me-2 text-success"></i><strong>Điện thoại:</strong> 091 708 6650 (Tư vấn)</p>
                <p><i class="bi bi-geo-alt me-2 text-danger"></i><strong>Địa chỉ:</strong> 22 Nguyễn Chánh, Trung Hòa, Cầu Giấy</p>
                <a href="https://www.google.com/maps/search/?api=1&query=22+Nguyễn+Chánh,+Trung+Hòa,+Cầu+Giấy" target="_blank" class="btn btn-outline-primary btn-sm mt-2">
                    <i class="bi bi-map"></i> Xem chỉ đường
                </a>
            </div>
        </div>

        <!-- Cửa hàng 2 -->
        <div class="col">
            <div class="border rounded p-3 shadow-sm h-100">
                <h5 class="fw-bold">Savor Cake Hoàng Đạo Thúy</h5>
                <p><i class="bi bi-clock me-2 text-primary"></i><strong>Giờ mở cửa:</strong> 8h - 22h T2-CN</p>
                <p><i class="bi bi-telephone me-2 text-success"></i><strong>Điện thoại:</strong> 091 234 5678 (Đặt bánh)</p>
                <p><i class="bi bi-geo-alt me-2 text-danger"></i><strong>Địa chỉ:</strong> 85 Hoàng Đạo Thúy, Trung Hòa, Cầu Giấy</p>
                <a href="https://www.google.com/maps/search/?api=1&query=85+Hoàng+Đạo+Thúy,+Trung+Hòa,+Cầu+Giấy" target="_blank" class="btn btn-outline-primary btn-sm mt-2">
                    <i class="bi bi-map"></i> Xem chỉ đường
                </a>
            </div>
        </div>

        <!-- Cửa hàng 3 -->
        <div class="col">
            <div class="border rounded p-3 shadow-sm h-100">
                <h5 class="fw-bold">Savor Cake Hà Đông</h5>
                <p><i class="bi bi-clock me-2 text-primary"></i><strong>Giờ mở cửa:</strong> 9h - 21h T2-CN</p>
                <p><i class="bi bi-telephone me-2 text-success"></i><strong>Điện thoại:</strong> 098 765 4321 (Hỗ trợ)</p>
                <p><i class="bi bi-geo-alt me-2 text-danger"></i><strong>Địa chỉ:</strong> 123 Quang Trung, Hà Đông, Hà Nội</p>
                <a href="https://www.google.com/maps/search/?api=1&query=123+Quang+Trung,+Hà+Đông,+Hà+Nội" target="_blank" class="btn btn-outline-primary btn-sm mt-2">
                    <i class="bi bi-map"></i> Xem chỉ đường
                </a>
            </div>
        </div>

    </div>
</section>

<section class="bg-light py-5">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-md-6">
                <img src="/DA1/Assets/image/products/Sweet Cake.jpg" class="img-fluid rounded shadow" alt="Tiệm bánh">

            </div>
            <div class="col-md-6">
                <h3 class="text-primary fw-bold">🎨 Nghệ thuật từ bếp bánh</h3>
                <p class="lead">
                    Chào mừng bạn đến với <strong>tiệm bánh thủ công cao cấp</strong> – nơi mỗi chiếc bánh không chỉ là món ăn, mà còn là một tác phẩm nghệ thuật mang đậm dấu ấn cá nhân.
                </p>
                <p>
                    Với <strong>nguyên liệu tuyển chọn</strong> từ thiên nhiên, chúng tôi cam kết không sử dụng chất bảo quản và luôn đảm bảo độ tươi mới trong từng lớp bánh.
                </p>
                <p>
                    Đội ngũ nghệ nhân làm bánh của chúng tôi không ngừng sáng tạo để biến mọi ý tưởng thành hiện thực – từ những chiếc bánh sinh nhật đáng yêu cho bé yêu đến các mẫu bánh sang trọng cho sự kiện đặc biệt.
                </p>
                <p>
                    🎂 Hãy để chúng tôi đồng hành cùng bạn tạo nên <strong>những khoảnh khắc ngọt ngào và đáng nhớ</strong>.
                </p>
                <a href="?action=contact" class="btn btn-outline-primary mt-3">📞 Liên hệ để thiết kế bánh của riêng bạn</a>
            </div>
        </div>
    </div>
</section>
<!-- Bootstrap JS (kèm Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>