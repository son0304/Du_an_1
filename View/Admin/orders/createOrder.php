<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tạo mới đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center">Lên đơn mới</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6 mt-2">
                    <label class="form-label">Người tạo</label>
                    <select name="id_user" class="form-control" required="">
                        <?php foreach ($users as $user): ?>
                            <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-6 mt-2">
                    <label class="form-label">Size</label>
                    <select id="sizeSelect" class="form-control" required>
                        <option value="">-- Chọn kích cỡ --</option>
                        <?php foreach ($sizes as $size): ?>
                            <option value="<?= $size['id'] ?>"><?= $size['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-6 mt-2">
                    <label class="form-label">Tên sản phẩm</label>
                    <select name="id_productsize" id="productSelect" class="form-control" required>
                        <option value="">-- Chọn sản phẩm --</option>
                        <?php foreach ($product_sizes as $product_size): ?>
                            <option value="<?= $product_size['id'] ?>" data-size="<?= $product_size['id_size'] ?>" data-price="<?= $product_size['price'] ?>">
                                <?= $product_size['id_product'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-6 mt-2">
                    <label class="form-label">Giá</label>
                    <input type="text" id="priceInput" class="form-control" readonly>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        let sizeSelect = document.getElementById("sizeSelect");
                        let productSelect = document.getElementById("productSelect");
                        let priceInput = document.getElementById("priceInput");

                        function filterProductsBySize() {
                            let selectedSize = sizeSelect.value;
                            let options = productSelect.options;

                            for (let i = 1; i < options.length; i++) { // Bỏ qua option đầu tiên (placeholder)
                                let optionSize = options[i].getAttribute("data-size");
                                options[i].style.display = (optionSize === selectedSize || selectedSize === "") ? "block" : "none";
                            }

                            // Nếu không có sản phẩm nào phù hợp, reset select và giá
                            productSelect.selectedIndex = 0;
                            priceInput.value = "";
                        }

                        function updatePrice() {
                            let selectedOption = productSelect.options[productSelect.selectedIndex];
                            let price = selectedOption.getAttribute("data-price");

                            if (price) {
                                priceInput.value = new Intl.NumberFormat('vi-VN').format(price) + " VND";
                            } else {
                                priceInput.value = "";
                            }
                        }

                        sizeSelect.addEventListener("change", filterProductsBySize);
                        productSelect.addEventListener("change", updatePrice);
                    });
                </script>

                <div class="col-6 mt-2">
                    <label class="form-label">Tên khách hàng</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-6 mt-2">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" name="address" class="form-control" required>
                </div>
                <div class="col-6 mt-2">
                    <label class="form-label">SĐT</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="col-6 mt-2 d-none">
                    <label class="form-label">Trạng thái</label>
                    <input type="text" name="status" value="<?= ucfirst(strtolower(STATUS_UNCOMFIRMED)) ?>" class="form-control" readonly>
                </div>
                <div class="col-6 mt-2">
                    <label class="form-label">Ngày tạo</label>
                    <input type="date" name="created_at" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Tạo mới</button>
                    <a href="dashboard.php?action=orders" class="btn btn-secondary">Hủy</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>