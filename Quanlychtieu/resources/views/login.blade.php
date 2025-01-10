<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Chi Tiêu - Đăng Nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: url('https://source.unsplash.com/1920x1080/?finance,money') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 400px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }
        h4.card-title {
    font-weight: bold;
    color: #4e54c8;
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
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
            width: 100%;
            border-radius: 15px;
            font-weight: bold;
        }

        .btn-google {
            background-color: #4285F4;
            color: white;
            border: none;
        }

        .btn-facebook {
            background-color: #1877F2;
            color: white;
            border: none;
        }

        .btn-google:hover {
            background-color:white;
        }

        .btn-facebook:hover {
            background-color:white;
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
    </style>
</head>
<body>

    <div class="card shadow-lg">
        <div class="card-body">
            <h4 class="card-title text-center fw-bold">Quản Lý Chi Tiêu</h4>
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
            <div class="text-center mt-3">
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

            // Lưu thông tin người dùng đang đăng nhập
            localStorage.setItem('currentUser', JSON.stringify(users[email]));

            alert('Đăng nhập thành công!');
            window.location.href = 'dashboard.blade.php';
        });

        // Thêm sự kiện cho nút Google và Facebook
        document.querySelector('.btn-google').addEventListener('click', () => {
            alert('Tính năng đăng nhập Google chưa được tích hợp.');
        });

        document.querySelector('.btn-facebook').addEventListener('click', () => {
            alert('Tính năng đăng nhập Facebook chưa được tích hợp.');
        });
    </script>
</body>
</html>
