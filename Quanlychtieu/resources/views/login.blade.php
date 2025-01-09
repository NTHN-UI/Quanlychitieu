<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Chi Tiêu - Đăng Nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            width: 400px;
            border-radius: 10px;
        }
        .card-body {
            padding: 20px;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #3b3ccf, #4e54c8);
        }
        .form-switch {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="card shadow-lg">
        <div class="card-body">
            <h4 class="card-title text-center">Quản lý Chi Tiêu - Đăng Nhập</h4>
            <form id="login-form">
                <div class="mb-3">
                    <label for="login-email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="login-email" placeholder="Nhập email" required>
                </div>
                <div class="mb-3">
                    <label for="login-password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="login-password" placeholder="Nhập mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
            </form>
            <div class="form-switch text-center mt-3">
                <small>Bạn chưa có tài khoản? <a href="register.blade.php">Đăng Ký</a></small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
       document.getElementById('login-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = document.getElementById('login-email').value.trim();
    const password = document.getElementById('login-password').value.trim();

    if (!email || !password) {
        alert('Vui lòng điền đầy đủ thông tin.');
        return;
    }

    // Lấy danh sách người dùng từ localStorage
    const users = JSON.parse(localStorage.getItem('users')) || {};

    // Kiểm tra thông tin đăng nhập
    if (!users[email] || users[email].password !== password) {
        alert('Email hoặc mật khẩu không chính xác.');
        return;
    }

    alert('Đăng nhập thành công!');
    // Lưu thông tin người dùng đang đăng nhập
    localStorage.setItem('currentUser', users[email].name);

    // Chuyển sang giao diện quản lý chi tiêu
    window.location.href = 'dashboard.blade.php';
});




    </script>
</body>
</html>
