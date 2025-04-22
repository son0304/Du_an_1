<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yêu cầu đăng nhập</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #e0f7fa, #fff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .container {
            text-align: center;
            max-width: 400px;
            padding: 40px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            font-size: 72px;
            margin: 0;
            color: #ff6b6b;
        }

        .container h2 {
            font-size: 24px;
            margin-top: 10px;
            color: #333;
        }

        .container p {
            font-size: 16px;
            color: #666;
            margin: 15px 0 30px;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .icon {
            font-size: 40px;
            margin-bottom: 15px;
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="icon">🔒</div>
        <h1>Oops!</h1>
        <h2>Bạn chưa đăng nhập</h2>
        <p>Để tiếp tục, vui lòng đăng nhập vào hệ thống.</p>
        <a href="login.php" class="btn">Đăng nhập ngay</a>
    </div>
</body>

</html>
