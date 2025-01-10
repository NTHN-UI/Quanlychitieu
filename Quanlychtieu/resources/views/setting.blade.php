<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>Settings Page</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
        }

        nav {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            color: white;
            width: 220px;
            height: 100vh;
            box-shadow: 4px 0 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
            z-index: 10;
        }

        nav .nav-link {
            color: white;
            margin-bottom: 15px;
            font-weight: 500;
            padding: 12px 16px;
            border-radius: 8px;
            transition: background 0.3s, transform 0.3s;
        }

        nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(10px);
        }

        nav .nav-link.active {
            background: rgba(255, 255, 255, 0.4);
            font-weight: bold;
        }

        .main-content {
            margin-left: 240px;
            padding: 20px;
            overflow-y: auto;
            height: 100vh;
            background: linear-gradient(135deg, #ffffff, #f2f6fc);
        }

        .container {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            max-width: 900px;
            margin: auto;
        }
        .header {
            padding: 20px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            background: #f1f1f1;
        }
        .menu-item {
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }
        .menu-item:last-child {
            border-bottom: none;
        }
        .menu-item:hover {
            background: #f5f5f5;
        }
        .menu-item .icon {
            display: flex;
            align-items: center;
            gap: 15px; /* Thêm khoảng cách giữa icon và chữ */
        }
        .footer {
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            background: #f1f1f1;
        }
        .footer button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background: #007bff;
            color: #fff;
            cursor: pointer;
        }
        .footer button:hover {
            background: #0056b3;
        }
        .language-switch {
            display: flex;
            align-items: center;
        }
        .language-switch select {
            margin-left: 10px;
            padding: 5px;
        }
        #user-name {
            font-size: 18px;
            font-weight: bold;
            color: #4e54c8; /* Màu nổi bật */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<nav>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="dashboard.blade.php" class="nav-link" id="nav-dashboard">Dashboard</a></li>
            <li class="nav-item"><a href="expense.blade.php" class="nav-link" id="nav-expense">Thu chi</a></li>
            <li class="nav-item"><a href="transaction.blade.php" class="nav-link" id="nav-transaction">Sổ giao dịch</a></li>
            <li class="nav-item"><a href="remind.blade.php" class="nav-link" id="nav-remind">Nhắc nhở</a></li>
            <li class="nav-item"><a href="bugdget.blade.php" class="nav-link ">Ngân sách</a></li>
            <li class="nav-item"><a href="setting.blade.php" class="nav-link active" id="nav-settings">Cài đặt</a></li>
        </ul>
    </nav>
    <div class="main-content">
    <div class="container">
        <div class="header" id="header-settings">Cài đặt</div>
        <div class="menu-item">
            <div class="icon">
                <i class="bi bi-person-circle"></i> 
                <span id="user-name" style="margin-left: 10px;"></span>
            </div>
        </div>
        <div class="menu-item">
    <div class="icon">
        <i class="bi bi-question-circle"></i> <span id="menu-help">Trung tâm trợ giúp</span>
    </div>
</div>
<div class="menu-item">
    <div class="icon">
        <i class="bi bi-chat-dots"></i> <span id="menu-feedback">Chia sẻ góp ý</span>
    </div>
</div>
<div class="menu-item">
    <div class="icon">
        <i class="bi bi-translate"></i> <span id="menu-language">Ngôn ngữ</span>
    </div>
    <div class="language-switch">
        <select id="language-switch" onchange="changeLanguage(this.value)">
            <option value="en">EN</option>
            <option value="vi" selected>VI</option>
        </select>
    </div>
</div>

        <div class="footer">
            <button onclick="logout()" id="btn-logout">Đăng xuất</button>
            <button onclick="logout()" id="btn-switch-account">Đổi tài khoản</button>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function logout() {
            localStorage.removeItem('currentUser');
            window.location.href = 'login.blade.php';
}

         // Lấy tên người dùng từ localStorage hoặc hiển thị mặc định nếu chưa đăng nhập
       // Lấy thông tin người dùng hiện tại từ localStorage
        const currentUser = localStorage.getItem('currentUser') || 'Chưa đăng nhập';
        document.getElementById('user-name').textContent = currentUser;

    </script>
</body>
</html>
