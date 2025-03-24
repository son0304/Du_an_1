<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class=" container mt-4">
        <h2 class="text-center">Thêm sản phẩm</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3 row">
                <div class="col-7">
                    <div>
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                    </div>
                    <div>
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter description"></textarea>
                    </div>
                    <div>
                        <label for="description" class="form-label">Image</label>
                        <input type="file" class="form-control" id="description" name="img" placeholder="Enter image">
                    </div>
                </div>
                <div class="col-5">
                    <div>
                        <label for="name" class="form-label">Category</label>
                        <select class="form-select" name="id_category" id="">
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>

                        <div class="my-4">
                            <h3>Chọn kích cỡ và giá</h3>
                            <div id="sizes-container">
                                <div class="size-item row">
                                    <div class="col">
                                        <input class="form-control" type="text" name="size[size][]" placeholder="Tên kích cỡ ">
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="text" name="size[price][]" placeholder="Giá">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success my-3" type="button" onclick="addSize()">Thêm kích cỡ</button>

                    </div>
                </div>
            </div>
            <div>
                <button class="btn btn-primary w-100">Submit</button>
            </div>
        </form>
    </div>

    <script>
        function addSize() {
            let container = document.getElementById('sizes-container');
            let div = document.createElement('div');
            div.classList.add('size-item', 'row', 'mt-2'); // Thêm margin top để dễ nhìn
            div.innerHTML = `
        <div class="col">
            <input class="form-control" type="text" name="size[size][]" placeholder="Tên kích cỡ ">
        </div>
        <div class="col">
            <input class="form-control" type="text" name="size[price][]" placeholder="Giá">
        </div>`;
            container.appendChild(div);
        }
    </script>
</body>

</html>