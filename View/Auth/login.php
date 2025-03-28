<?php
require_once __DIR__ . '/../../Controller/auth.php';
require_once __DIR__ . '/../../Config/config.php';



$auth = new AuthController($conn);
$error = $auth->login();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fc;
        }

        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h3 class="text-center mb-4">Welcome Sweet-Cake</h3>

        <form action="" method="POST">
            <div class="mb-3">
                <input type="text" class="form-control" name="name" placeholder="Enter Email Address..." required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="rememberMe">
                <label class="form-check-label" for="rememberMe"> Remember Me </label>
            </div>
            <button type="submit" class="btn btn-primary w-100 rounded-pill">Login</button>
        </form>

        <div class="text-center">
            <a href="#" class="text-decoration-none">Forgot Password?</a>
        </div>
        <div class="text-center mt-2">
            <a href="#" class="text-decoration-none">Create an Account!</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>