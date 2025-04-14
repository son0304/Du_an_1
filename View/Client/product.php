<div class="container py-5">
    <h2 class="text-center mb-5 text-primary">Danh sách sản phẩm</h2>
    <div class="row g-4">
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
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-lg border-0 rounded">
                    <img src="/Du_an_1/Assets/image/products/<?= htmlspecialchars($product_info['product_image']) ?>"
                        class="card-img-top rounded-top" alt="Ảnh sản phẩm">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-primary"> <?= htmlspecialchars($product_info['product_name']); ?></h5>
                        <p class="card-text text-muted small">Danh mục: <?= htmlspecialchars($product_info['category_name']); ?></p>
                        <p class="card-text">Mô tả: <?= nl2br(htmlspecialchars($product_info['product_description'])); ?></p>
                        <label>Chọn kích thước:</label>
                        <div class="btn-group d-flex mt-2" role="group">
                            <?php foreach ($sizes as $index => $size): ?>
                                <button type="button" class="btn btn-outline-primary size-btn"
                                    data-product-id="<?= $product_id; ?>"
                                    data-price="<?= $size['size_price']; ?>">
                                    <?= htmlspecialchars($size['size_name']); ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                        <p class="mt-3 fw-bold text-danger">Giá: <span id="price-<?= $product_id; ?>">
                                <?= number_format($sizes[0]['size_price'], 0, ',', '.'); ?> VND
                            </span></p>
                    </div>
                    <div class="card-footer bg-white text-center py-3">
                        <a href="">
                            <button class="btn btn-outline-primary add-to-cart" data-id="<?= $product_id; ?>">🛒 Thêm vào giỏ</button>
                        </a>
                        <a href="?action=order&id=<?= $product_id; ?>&size=<?= urlencode($sizes[0]['size_name']); ?>"
                            class="buy-now-link"
                            data-product-id="<?= $product_id; ?>"
                            data-default-size="<?= $sizes[0]['size_name']; ?>">
                            <button class="btn btn-danger buy-now">⚡ Mua ngay</button>
                        </a>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    document.querySelectorAll('.size-btn').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const selectedPrice = this.getAttribute('data-price');
            const selectedSize = this.innerText.trim(); 
            document.getElementById('price-' + productId).innerText = parseInt(selectedPrice).toLocaleString('vi-VN') + ' VND';
            const buyNowLink = document.querySelector(`.buy-now-link[data-product-id="${productId}"]`);
            buyNowLink.href = `?action=order&id=${productId}&size=${encodeURIComponent(selectedSize)}`;
            this.parentElement.querySelectorAll('.size-btn').forEach(btn => btn.classList.remove('btn-primary'));
            this.classList.add('btn-primary');
        });
    });

    // Đảm bảo đường dẫn mặc định khi trang tải lên
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.buy-now-link').forEach(link => {
            const productId = link.getAttribute('data-product-id');
            const defaultSize = link.getAttribute('data-default-size');
            link.href = `?action=order&id=${productId}&size=${encodeURIComponent(defaultSize)}`;
        });
    });
</script>