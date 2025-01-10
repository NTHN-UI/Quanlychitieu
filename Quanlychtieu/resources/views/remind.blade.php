<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhắc nhở</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f8f9fa, #e3e7ed);
            margin: 0;
            height: 100vh;
            overflow-x: hidden;
        }

        nav {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            /* Gradient tím xanh nhẹ */
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
            /* Space for fixed sidebar */
            padding: 20px;
            overflow-y: auto;
            height: 100vh;
            background: linear-gradient(135deg, #ffffff, #f2f6fc);
            /* Màu nền sáng tinh tế */
        }

        .container {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            max-width: 900px;
            margin: auto;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            color: #4e54c8;
            font-weight: bold;
        }

        .btn-info {
            background: none;
            /* Xóa nền mặc định */
            border: none;
            /* Xóa viền mặc định */
            padding: 0;
            /* Xóa padding mặc định */
            cursor: pointer;
            /* Con trỏ dạng tay khi hover */
        }

        .btn-info:hover {
            background: none !important;
            /* Loại bỏ nền khi hover */
            box-shadow: none;
            /* Loại bỏ bóng */
        }

        .btn-info i {
            font-size: 16px;
            /* Kích thước icon */
            color: black;
            /* Màu đen cho biểu tượng */
            transition: transform 0.2s ease;
            /* Hiệu ứng phóng to nhẹ khi hover */
        }

        .btn-info:hover i {
            transform: scale(1.2);
            /* Phóng to nhẹ khi hover */
        }

        .card-footer {
            border-top: 1px solid #ddd;
            border-radius: 0 0 12px 12px;
            background: #f9f9f9;
            padding: 15px;
        }

        .form-check-input {
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            border: none;
            font-weight: bold;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #3b3ccf, #4e54c8);
        }

        .hidden {
            display: none;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 34px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 20px;
        }

        .slider:before {
            position: absolute;
            content: '';
            height: 14px;
            width: 14px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #4CAF50;
        }

        input:checked+.slider:before {
            transform: translateX(14px);
        }

        .btn-link {
            color: #4e54c8;
            text-decoration: none;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .alert-info {
            background-color: #eaf4fc;
            border-color: #b6e1fe;
            color: #31708f;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        #floating-notifications .notification {
            background-color: #4e54c8;
    color: white;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 10px;
    font-size: 14px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    animation: slideIn 0.5s ease;
@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

    </style>
</head>

<body>
    <div>
        <!-- Sidebar Navigation -->
        <nav>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="dashboard.blade.php" class="nav-link ">Dashboard</a></li>
                <li class="nav-item"><a href="expense.blade.php" class="nav-link ">Thu chi</a></li>
                <li class="nav-item"><a href="transaction.blade.php" class="nav-link">Sổ giao dịch</a></li>
                <li class="nav-item"><a href="remind.blade.php" class="nav-link active">Nhắc nhở</a></li>
                <li class="nav-item"><a href="bugdget.blade.php" class="nav-link ">Ngân sách</a></li>
                <li class="nav-item"><a href="setting.blade.php" class="nav-link">Cài đặt</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <div class="container">
                <h2 class="text-center mb-4">Nhắc nhở</h2>
                <div id="notification-area" class="mb-4"></div>
                <!-- Reminder Item -->
                <!-- Reminder List -->
                <div id="reminder-list">
                    <p class="text-center text-muted">Chưa có nhắc nhở nào.</p>
                </div>
                <!-- Nút kích hoạt modal -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReminderModal">+ Tạo Nhắc Nhở</button>

                <!-- Modal Bootstrap -->
                <div class="modal fade" id="addReminderModal" tabindex="-1" aria-labelledby="addReminderModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addReminderModalLabel">Tạo Nhắc Nhở Mới</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="add-reminder-form">
                                    <div class="mb-3">
                                        <label for="reminder-title" class="form-label">Tên nhắc nhở <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="reminder-title" placeholder="Nhập tên nhắc nhở" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="reminder-date" class="form-label">Ngày thực hiện <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="reminder-date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="reminder-category" class="form-label">Loại chi tiêu</label>
                                        <select class="form-select" id="reminder-category">
                                            <option value="hoa-don" selected>Hóa đơn</option>
                                            <option value="tiet-kiem">Tiết kiệm</option>
                                            <option value="dau-tu">Đầu tư</option>
                                            <option value="ca-nhan">Cá nhân</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Lưu Nhắc Nhở</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Bootstrap -->
                <!-- Modal Chi Tiết Nhắc Nhở -->
<div class="modal fade" id="reminderDetailsModal" tabindex="-1" aria-labelledby="reminderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reminderDetailsModalLabel">Chi Tiết Nhắc Nhở</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reminder-details-form">
                    <div class="mb-3">
                        <label for="detail-title" class="form-label">Ghi chú</label>
                        <input type="text" class="form-control" id="detail-title" placeholder="Nhập ghi chú">
                    </div>
                    <div class="mb-3">
                        <label for="detail-date" class="form-label">Ngày</label>
                        <input type="date" class="form-control" id="detail-date">
                    </div>
                    <div class="mb-3">
                        <label for="detail-repeat" class="form-label">Lặp lại</label>
                        <select class="form-select" id="detail-repeat">
                            <option value="khong">Không lặp lại</option>
                            <option value="hang-ngay">Hằng ngày</option>
                            <option value="hang-tuan">Hằng tuần</option>
                            <option value="hang-thang">Hằng tháng</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="detail-priority" class="form-label">Mức ưu tiên</label>
                        <select class="form-select" id="detail-priority">
                            <option value="khong-co">Không có</option>
                            <option value="thap">Thấp</option>
                            <option value="trung-binh">Trung bình</option>
                            <option value="cao">Cao</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="detail-list" class="form-label">Danh sách</label>
                        <select class="form-select" id="detail-list">
                            <option value="loi-nhac">Lời nhắc</option>
                            <option value="lich">Lịch</option>
                        </select>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="detail-active">
                        <label class="form-check-label" for="detail-active">Bật Nhắc Nhở</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Lưu Thay Đổi</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="floating-notifications" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; width: 300px;"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>


                <!-- Bootstrap JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    const renderReminders = () => {
                        const reminders = JSON.parse(localStorage.getItem('reminders')) || [];
                        const reminderList = document.getElementById('reminder-list');

                        // Nếu không có nhắc nhở nào, hiển thị thông báo
                        if (reminders.length === 0) {
                            reminderList.innerHTML = '<p class="text-center text-muted">Chưa có nhắc nhở nào.</p>';
                            return;
                        }

                        // Xóa thông báo rỗng nếu có nhắc nhở
                        reminderList.innerHTML = '';

                        // Hiển thị danh sách nhắc nhở
                        reminders.forEach((reminder, index) => {
                            const reminderCard = document.createElement('div');
                            reminderCard.className = 'card mb-3';

                            reminderCard.innerHTML = `
  <div class="card-body d-flex justify-content-between align-items-center">
    <div>
      <h5 class="card-title">${reminder.title}</h5>
      <p class="card-text"><strong>Ngày:</strong> ${reminder.date}</p>
      <p class="card-text"><strong>Loại:</strong> ${reminder.category}</p>
      <p class="card-text"><strong>Lặp lại:</strong> ${reminder.repeat === 'khong' ? 'Không lặp lại' : reminder.repeat}</p>
    </div>
    <div>
      <button class="btn btn-sm btn-info" data-index="${index}" onclick="showReminderDetails(${index})">
        <i class="fas fa-info-circle"></i>
      </button>
    </div>
  </div>
`;


                            reminderList.appendChild(reminderCard);
                        });
                    };

                    // Hiển thị nhắc nhở khi tải trang
                    document.addEventListener('DOMContentLoaded', renderReminders);
                    // Hiển thị thông tin chi tiết nhắc nhở
const showReminderDetails = (index) => {
    const reminders = JSON.parse(localStorage.getItem('reminders')) || [];
    const reminder = reminders[index];

    // Điền thông tin vào modal
    document.getElementById('detail-title').value = reminder.title || '';
    document.getElementById('detail-date').value = reminder.date || '';
    document.getElementById('detail-repeat').value = reminder.repeat || 'khong';
    document.getElementById('detail-priority').value = reminder.priority || 'khong-co';
    document.getElementById('detail-list').value = reminder.list || 'loi-nhac';
    document.getElementById('detail-active').checked = reminder.active || false;

    // Lưu chỉ số nhắc nhở để cập nhật sau
    document.getElementById('reminder-details-form').setAttribute('data-index', index);

    // Hiển thị modal
    const modal = new bootstrap.Modal(document.getElementById('reminderDetailsModal'));
    modal.show();
};

// Cập nhật thông tin nhắc nhở
document.getElementById('reminder-details-form').addEventListener('submit', (e) => {
    e.preventDefault();

    const index = e.target.getAttribute('data-index');
    const reminders = JSON.parse(localStorage.getItem('reminders')) || [];

    // Cập nhật thông tin nhắc nhở
    reminders[index].title = document.getElementById('detail-title').value;
    reminders[index].date = document.getElementById('detail-date').value;
    reminders[index].repeat = document.getElementById('detail-repeat').value;
    reminders[index].priority = document.getElementById('detail-priority').value;
    reminders[index].list = document.getElementById('detail-list').value;
    reminders[index].active = document.getElementById('detail-active').checked;

    // Lưu lại vào localStorage
    localStorage.setItem('reminders', JSON.stringify(reminders));

    // Đóng modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('reminderDetailsModal'));
    modal.hide();

    // Hiển thị lại danh sách nhắc nhở
    renderReminders();

    alert('Thông tin nhắc nhở đã được cập nhật!');
});

const updateReminder = async (index) => {
    const reminder = {
        title: document.getElementById('detail-title').value,
        date: document.getElementById('detail-date').value,
        repeat: document.getElementById('detail-repeat').value,
        priority: document.getElementById('detail-priority').value,
        list: document.getElementById('detail-list').value,
        active: document.getElementById('detail-active').checked,
    };

    try {
        const response = await fetch(`/reminders/${index}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(reminder),
        });
        if (response.ok) {
            alert('Nhắc nhở đã được cập nhật!');
        } else {
            alert('Lỗi cập nhật nhắc nhở!');
        }
    } catch (error) {
        console.error('Error updating reminder:', error);
    }
};


                    document.getElementById('add-reminder-form').addEventListener('submit', (e) => {
                        e.preventDefault();

                        // Lấy dữ liệu từ form
                        const title = document.getElementById('reminder-title').value.trim();
                        const date = document.getElementById('reminder-date').value;
                        const category = document.getElementById('reminder-category').value;

                        if (!title || !date) {
                            alert('Vui lòng điền đầy đủ thông tin bắt buộc!');
                            return;
                        }

                        // Tạo nhắc nhở mới
                        const newReminder = {
    title,
    date,
    category,
    repeat: document.getElementById('detail-repeat').value || 'khong',
    active: true, // Nhắc nhở mặc định được bật
};

                        // Lưu nhắc nhở vào localStorage
                        const reminders = JSON.parse(localStorage.getItem('reminders')) || [];
                        reminders.push(newReminder);
                        localStorage.setItem('reminders', JSON.stringify(reminders));

                        // Reset form và đóng modal
                        e.target.reset();
                        const modal = bootstrap.Modal.getInstance(document.getElementById('addReminderModal'));
                        modal.hide();

                        // Hiển thị lại danh sách nhắc nhở
                        renderReminders();

                        // Thông báo thành công
                        alert(`Nhắc nhở "${title}" đã được thêm thành công!`);
                    });

const displayFloatingNotifications = (notifications) => {
    const notificationContainer = document.getElementById('floating-notifications');
    notifications.forEach((message, index) => {
        // Tạo thông báo
        const notificationElement = document.createElement('div');
        notificationElement.className = 'notification';
        notificationElement.innerHTML = `
            <span>${message}</span>
            
        `;
        notificationContainer.appendChild(notificationElement);

        // Tự động xóa thông báo sau 5 giây
        setTimeout(() => {
            notificationElement.remove();
        }, 5000 + index * 500); // Hiển thị cách nhau 0.5 giây
    });
};

// Hàm kiểm tra nhắc nhở và lưu vào localStorage
const checkReminders = () => {
    const reminders = JSON.parse(localStorage.getItem('reminders')) || [];
    const today = new Date();
    const todayString = today.toISOString().split('T')[0]; // YYYY-MM-DD
    const notifications = []; // Danh sách thông báo

    reminders.forEach((reminder) => {
        if (!reminder.active) return;

        const reminderDate = new Date(reminder.date);
        const repeat = reminder.repeat;
        const reminderDay = reminderDate.getDate();
        const reminderWeekday = reminderDate.getDay();

        let showReminder = false;

        // Kiểm tra điều kiện lặp lại
        if (repeat === 'khong' && reminder.date === todayString) {
            showReminder = true;
        } else if (repeat === 'hang-ngay') {
            showReminder = true;
        } else if (repeat === 'hang-tuan' && today.getDay() === 1) {
            showReminder = true;
        } else if (repeat === 'hang-thang' && today.getDate() === reminderDay) {
            showReminder = true;
        }

        if (showReminder) {
            notifications.push(`Nhắc nhở: ${reminder.title} vào hôm nay.`);
        }
    });

    // Lưu thông báo vào localStorage
    if (notifications.length > 0) {
        localStorage.setItem('todayNotifications', JSON.stringify(notifications));
    }
};

// Hiển thị thông báo khi tải trang
document.addEventListener('DOMContentLoaded', () => {
    const todayNotifications = JSON.parse(localStorage.getItem('todayNotifications')) || [];
    if (todayNotifications.length > 0) {
        displayFloatingNotifications(todayNotifications);
        localStorage.removeItem('todayNotifications'); // Xóa thông báo sau khi hiển thị
    }
});

// Tự động kiểm tra nhắc nhở mỗi phút
setInterval(checkReminders, 60 * 1000);

// Kiểm tra nhắc nhở khi tải trang
document.addEventListener('DOMContentLoaded', checkReminders);


                    
                </script>
</body>

</html>