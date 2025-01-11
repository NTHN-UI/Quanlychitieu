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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            width: 400px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .card-body {
            padding: 25px;
        }

        .form-control {
            border-radius: 15px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            border: none;
            border-radius: 15px;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #3b3ccf, #4e54c8);
        }

        .btn-social {
            width: 100%;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            font-weight: bold;
        }

        .btn-google {
            background-color:#757575;
            color: white;
        }

        .btn-facebook {
            background-color: #1877F2;
            color: white;
        }

        .form-switch {
            margin-top: 20px;
        }

        .form-switch a {
            color: #4e54c8;
            text-decoration: none;
        }

        .form-switch a:hover {
            text-decoration: underline;
        }

        h4.card-title {
            font-weight: bold;
            color: #4e54c8;
        }
    </style>
</head>
<body>

    <div class="card shadow-lg">
        <div class="card-body">
            <h4 class="card-title text-center">Đăng Nhập</h4>
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
            <div class="mt-3">
                <button class="btn btn-google btn-social">
                    <i class="bi bi-google me-2"></i> Đăng nhập bằng Google
                </button>
                <button class="btn btn-facebook btn-social">
                    <i class="bi bi-facebook me-2"></i> Đăng nhập bằng Facebook
                </button>
            </div>
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

        // Xử lý nút Google và Facebook (chỉ hiển thị cảnh báo vì chưa tích hợp)
        document.querySelector('.btn-google').addEventListener('click', () => {
            alert('Tính năng đăng nhập bằng Google chưa được tích hợp.');
        });

        document.querySelector('.btn-facebook').addEventListener('click', () => {
            alert('Tính năng đăng nhập bằng Facebook chưa được tích hợp.');
        });
    </script>
</body>
</html>
