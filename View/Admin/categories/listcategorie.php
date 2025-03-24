<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <table class="table text-center">
        <thead>
            <h1 class="text-center">List Categories</h1>
            <a href="dashboard.php?action=createCategory">
                            <button class="btn btn-primary">Create</button>
                        </a>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Action</th>

        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <th><?= $category['id'] ?></th>
                    <th><?= $category['name'] ?></th>
                    <th>
                        <a href="dashboard.php?action=editCategory&id=<?= $category['id'] ?>">
                            <button class="btn btn-success">Update</button>
                        </a>

                    </th>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>