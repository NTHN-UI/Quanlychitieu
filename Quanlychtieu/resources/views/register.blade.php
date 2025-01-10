<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Chi Tiêu - Đăng Ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: url('https://source.unsplash.com/1920x1080/?finance,money') no-repeat center center/cover;
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
            <h4 class="card-title text-center">Đăng Ký Tài Khoản</h4>
            <form id="register-form">
                <div class="mb-3">
                    <label for="register-name" class="form-label">Họ và Tên</label>
                    <input type="text" class="form-control" id="register-name" placeholder="Nhập họ và tên" required>
                </div>
                <div class="mb-3">
                    <label for="register-email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="register-email" placeholder="Nhập email" required>
                </div>
                <div class="mb-3">
                    <label for="register-password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="register-password" placeholder="Nhập mật khẩu" required>
                </div>
                <div class="mb-3">
                    <label for="register-confirm-password" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" id="register-confirm-password" placeholder="Xác nhận mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng Ký</button>
            </form>
            <div class="form-switch text-center mt-3">
                <small>Bạn đã có tài khoản? <a href="login.blade.php">Đăng Nhập</a></small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('register-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const name = document.getElementById('register-name').value.trim();
            const email = document.getElementById('register-email').value.trim();
            const password = document.getElementById('register-password').value.trim();
            const confirmPassword = document.getElementById('register-confirm-password').value.trim();

            if (!name || !email || !password || !confirmPassword) {
                alert('Vui lòng điền đầy đủ thông tin.');
                return;
            }

            if (password !== confirmPassword) {
                alert('Mật khẩu không khớp.');
                return;
            }

            // Lấy danh sách người dùng từ localStorage
            const users = JSON.parse(localStorage.getItem('users')) || {};

            // Kiểm tra xem email đã tồn tại chưa
            if (users[email]) {
                alert('Email đã được đăng ký. Vui lòng sử dụng email khác.');
                return;
            }

            // Lưu thông tin người dùng vào localStorage
            users[email] = { name, password };
            localStorage.setItem('users', JSON.stringify(users));

            alert('Đăng ký thành công! Chuyển đến trang đăng nhập.');

            // Chuyển sang trang đăng nhập
            window.location.href = 'login.blade.php';
        });
    </script>
</body>
</html>
