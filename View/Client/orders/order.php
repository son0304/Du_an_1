<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 900px;
        }

        .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <form action="" method="post">
            <div class="row g-4">
                <!-- Danh sách sản phẩm -->
                <div class="col-lg-7">
                    <div class="card p-4">
                        <h4 class="text-center text-primary mb-3">Thông tin sản phẩm</h4>
                        <?php foreach ($products as $product) : ?>
                            <div class="row align-items-center mb-3 border-bottom pb-3">
                                <div class="col-3 text-center">

                                    <img src="/Du_an_1/Assets/image/products/<?= htmlspecialchars($product['img']) ?>" alt="Ảnh sản phẩm" class="product-img">
                                </div>
                                <div class="col-9">
                                    <h5 class="mb-1 text-dark"> <?= htmlspecialchars($product['name']) ?> </h5>
                                    <p class="text-danger fw-bold">Giá</p>
                                    <label for="quantity_<?= $product['id'] ?>" class="form-label small">Số lượng</label>
                                    <input type="number" name="quantity" id="quantity_<?= $product['id'] ?>" class="form-control form-control-sm w-50" min="1" value="1">
                                </div>
                            </div>


                        <?php endforeach ?>
                    </div>
                </div>

                <!-- Thông tin đơn hàng -->
                <div class="col-lg-5">
                    <div class="card p-4">
                        <h4 class="text-center text-primary mb-3">Thông tin đơn hàng</h4>
                        <div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Họ và Tên</label>
                                <input type="text" id="name" name="name" placeholder="Nhập tên" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <input type="text" id="address" name="address" placeholder="Nhập địa chỉ" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2">Xác nhận đặt hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>