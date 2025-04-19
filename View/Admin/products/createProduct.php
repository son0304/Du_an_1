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

        <?php if (!empty($errors['general'])): ?>
            <div class="alert alert-danger"><?= $errors['general'] ?></div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3 row">
                <div class="col-7">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" placeholder="Nhập tên sản phẩm">
                        <?php if (!empty($errors['name'])): ?>
                            <small class="text-danger"><?= $errors['name'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="description" name="description"
                            placeholder="Nhập mô tả"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                        <?php if (!empty($errors['description'])): ?>
                            <small class="text-danger"><?= $errors['description'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="img" class="form-label">Ảnh sản phẩm</label>
                        <input type="file" class="form-control" id="img" name="img">
                        <?php if (!empty($errors['img'])): ?>
                            <small class="text-danger"><?= $errors['img'] ?></small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-5">
                    <div class="mb-3">
                        <label for="id_category" class="form-label">Danh mục</label>
                        <select class="form-select" name="id_category" id="id_category">
                            <option value="">-- Chọn danh mục --</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= isset($_POST['id_category']) && $_POST['id_category'] == $category['id'] ? 'selected' : '' ?>>
                                    <?= $category['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($errors['id_category'])): ?>
                            <small class="text-danger"><?= $errors['id_category'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="my-4">
                        <h5>Chọn kích cỡ và giá</h5>
                        <div id="sizes-container">
                            <div class="size-item row">
                                <div class="col">
                                    <label for="size" class="form-label">Kích cỡ</label>
                                    <select name="size[size][]" class="form-select">
                                        <?php foreach ($sizes as $size): ?>
                                            <option value="<?= $size['id'] ?>"><?= $size['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label">Giá</label>
                                    <input class="form-control" type="text" name="size[price][]" placeholder="Giá">
                                </div>
                            </div>
                        </div>
                        <?php if (!empty($errors['size'])): ?>
                            <small class="text-danger"><?= $errors['size'] ?></small>
                        <?php endif; ?>

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
            let div = document.createElement('div');
            div.classList.add('size-item', 'row', 'mt-2');

            div.innerHTML = `
                <div class="col">
                    <label for="size" class="form-label">Kích cỡ</label>
                    <select name="size[size][]" class="form-select">
                        <?php foreach ($sizes as $size): ?>
                            <option value="<?= $size['id'] ?>"><?= $size['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">Giá</label>
                    <input class="form-control" type="text" name="size[price][]" placeholder="Giá">
                </div>
            `;
            container.appendChild(div);
        }
    </script>
</body>

</html>
