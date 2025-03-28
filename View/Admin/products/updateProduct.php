<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center">Thêm sản phẩm</h2>
        <form action="" method="POST" enctype="multipart/form-data">

            <div class="mb-3 row">
                <div class="col-7">
                    <div>
                        <label for="name" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div>
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div>
                        <label for="img" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="img" name="img">
                    </div>
                </div>
                <div class="col-5">
                    <div>
                        <label for="id_category" class="form-label">Danh mục</label>
                        <select class="form-select" name="id_category" >
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Kích cỡ và giá -->
                    <div class="my-4">
                        <h3>Chọn kích cỡ và giá</h3>
                        <div id="sizes-container">
                            <div class="size-item row">
                                <div class="col">
                                    <input class="form-control" type="text" name="size[]" placeholder="Kích cỡ">
                                </div>
                                <div class="col">
                                    <input class="form-control" type="number" name="price[]" placeholder="Giá" min="0">
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-danger" onclick="removeSize(this)">Xóa</button>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success my-3" type="button" onclick="addSize()">Thêm kích cỡ</button>
                    </div>
                </div>
            </div>
            <div>
                <button class="btn btn-primary w-100">Lưu sản phẩm</button>
            </div>
        </form>
    </div>

    <script>
        function addSize() {
            let container = document.getElementById('sizes-container');
            let newSize = document.createElement('div');
            newSize.classList.add('size-item', 'row');
            newSize.innerHTML = `
                <div class="col">
                    <input class="form-control" type="text" name="size[]" placeholder="Kích cỡ">
                </div>
                <div class="col">
                    <input class="form-control" type="number" name="price[]" placeholder="Giá" min="0">
                </div>
                <div class="col">
                    <button type="button" class="btn btn-danger" onclick="removeSize(this)">Xóa</button>
                </div>
            `;
            container.appendChild(newSize);
        }

        function removeSize(button) {
            button.closest('.size-item').remove();
        }
    </script>
</body>

</html>