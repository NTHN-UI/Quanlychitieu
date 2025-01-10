<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Personal Finance Dashboard</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

        <style>
            /* General Styles */
            body {
                font-family: 'Roboto', Arial, sans-serif;
                margin: 0;
                height: 100vh;
                background: linear-gradient(135deg, #f7f9fc, #e9eff9);
                /* Màu nền tổng thể */
            }

            header {
                position: fixed; /* Giữ cố định */
    top: 0; /* Đặt ở trên cùng */
    left: 0; /* Căn bên trái */
    width: 100%; /* Phủ toàn bộ chiều ngang */
    height: 60px; /* Chiều cao của header */
    background: linear-gradient(135deg, #4e54c8, #8f94fb);
    color: white;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 0 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    z-index: 1000; /* Ưu tiên hiển thị trên các thành phần khác */
    }

    header .user-menu {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }

    header .user-menu span {
        font-weight: bold;
    }

    header .user-menu i {
        font-size: 1.2rem;
    }
    #dropdown-menu {
    position: absolute;
    top: 60px;
    right: 20px;
    background: linear-gradient(135deg, #ffffff, #f7f9fc); /* Gradient nhẹ */
    border-radius: 12px; /* Góc bo tròn lớn hơn */
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1); /* Đổ bóng mềm mại */
    display: none; /* Ẩn dropdown mặc định */
    z-index: 1001; /* Đảm bảo hiển thị trên mọi phần tử */
    overflow: hidden; /* Cắt các phần thừa nếu có */
    border: 1px solid #e0e0e0; /* Đường viền tinh tế */
}

#dropdown-menu ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

#dropdown-menu ul li {
    padding: 12px 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
    color: #4e54c8;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none; /* Bỏ gạch dưới */
}

#dropdown-menu ul li a {
    color: inherit; /* Kế thừa màu chữ từ li */
    text-decoration: none; /* Bỏ gạch dưới */
    display: flex;
    align-items: center;
    gap: 8px;
}

#dropdown-menu ul li:hover {
    background: linear-gradient(135deg, #8f94fb, #4e54c8);
    color: #ffffff;
    transform: translateX(5px);
}

#dropdown-menu ul li i {
    font-size: 18px;
    color: #8f94fb;
    transition: color 0.3s;
}

#dropdown-menu ul li:hover i {
    color: #ffffff;
}


            /* Sidebar Navigation */
            nav {
                background: linear-gradient(135deg, #4e54c8, #8f94fb);
                /* Gradient tím xanh nhẹ */
                color: white;
                width: 220px;
                height: 100vh;
                box-shadow: 4px 0 6px rgba(0, 0, 0, 0.1);
                position: fixed;
                top: 60px;
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

            /* Month Navigation */
            #prev-month,
            #next-month {
                font-size: 30px;
                color: #4e54c8;
                cursor: pointer;
                transition: color 0.3s, transform 0.3s;
            }

            #prev-month:hover,
            #next-month:hover {
                color: #3b3ccf;
                transform: scale(1.2);
            }

            /* Dropdown Styles */
            #month-selector {
                display: inline-block;
                width: auto;
                height: 40px;
            }

            /* Main Content */
            .main-content {
                margin-left: 240px;
                /* Space for fixed sidebar */
                padding-top: 60px;
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

            .month-navigation {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .month-navigation span {
                font-size: 36px;
                /* Increase size of arrows */
                color: #4e54c8;
                cursor: pointer;
                /* Change cursor to pointer */
                transition: color 0.3s, transform 0.3s;
            }

            .month-navigation span:hover {
                color: #3b3ccf;
                transform: scale(1.2);
                /* Slight zoom effect on hover */
            }

            .month-navigation h2 {
                font-size: 1.5rem;
                color: #4e54c8;
            }

            .card {
                border: none;
                border-radius: 12px;
                box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
                background: linear-gradient(135deg, #f8f9fc, #e9eff5);
                /* Card màu gradient nhẹ */
            }

            .card-title {
                color: #4e54c8;
                /* Tím xanh từ nav */
                font-weight: bold;
            }

            /* Buttons */
            .btn-primary {
                background: linear-gradient(135deg, #8f94fb, #4e54c8);
                border: none;
                font-weight: bold;
                transition: background 0.3s, transform 0.3s;
                color: white;
            }

            .btn-primary:hover {
                background: linear-gradient(135deg, #4e54c8, #3b3ccf);
                transform: translateY(-2px);
            }

            .btn-secondary {
                background: linear-gradient(135deg, #6dd5ed, #2193b0);
                /* Gradient xanh nước */
                border: none;
                font-weight: bold;
                transition: background 0.3s, transform 0.3s;
                color: white;
            }

            .btn-secondary:hover {
                background: linear-gradient(135deg, #2193b0, #17688d);
                transform: translateY(-2px);
            }

            /* Expense Categories */
            #expense-categories .list-group-item {
                background: #ffffff;
                /* Nền trắng nhẹ */
                color: #3b3ccf;
                /* Màu chữ xanh đậm */
                border: none;
                border-radius: 8px;
                margin-bottom: 10px;
                transition: background 0.3s, transform 0.3s;
            }

            #expense-categories .list-group-item:hover {
                background: #f1f4ff;
                /* Nền sáng hơn khi hover */
                transform: translateY(-3px);
            }
        </style>

    </head>

    <body>

    
        <!-- Sidebar Navigation -->
        <div>
        <nav>
            
            <ul class="nav flex-column">
                <li class="nav-item"><a href="dashboard.blade.php" class="nav-link active">Dashboard</a></li>
                <li class="nav-item"><a href="expense.blade.php" class="nav-link">Thu chi</a></li>
                <li class="nav-item"><a href="transaction.blade.php" class="nav-link">Sổ giao dịch</a></li>
                <li class="nav-item"><a href="remind.blade.php" class="nav-link">Nhắc nhở</a></li>
                <li class="nav-item"><a href="bugdget.blade.php" class="nav-link">Ngân sách</a></li>
                <li class="nav-item"><a href="courses.blade.php" class="nav-link ">Khoá học</a></li>
                <li class="nav-item"><a href="setting.blade.php" class="nav-link">Cài đặt</a></li>
            </ul>
        </nav>
        <header>
        <div class="user-menu" id="user-menu">
            <i class="bi bi-person-circle"></i>
            <span id="user-name"style="margin-left: 10px;"></span>
            
        </div>
        <div id="dropdown-menu">
            <ul>
                <li><i class="bi bi-person-circle"></i> <a href="#">Thông tin tài khoản</a></li>
                <li><i class="bi bi-lock"></i> <a href="#">Đổi mật khẩu</a></li>
                <li onclick="logout()"><i class="bi bi-box-arrow-right"></i> Đăng xuất</li>
            </ul>
        </div>
    </header>
        <div class="main-content">
            <div class="container">
                
                <!-- Month Navigation -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span id="prev-month">&lt;</span>
                    
                    <span id="next-month">&gt;</span>
                </div>
                <!-- Income and Expense Summary -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Thu Chi</h5>
                        <p><strong>Thu nhập:</strong> <span id="total-income"></span></p>
                        <p><strong>Chi tiêu:</strong> <span id="total-expense"></span></p>
                        <p><strong>Dòng tiền:</strong> <span id="net-balance"></span></p>
                        <p class="text-danger" id="over-budget-warning" style="display:none;"></p>
                    </div>
                </div>

                <!-- Spending by Category Chart -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Thu chi theo danh mục</h5>
                        <canvas id="category-chart"></canvas>
                        <button class="btn btn-secondary mt-3" id="export-pdf">Xuất dữ liệu PDF</button>
                    </div>
                </div>

                <!-- Expense Categories List -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Danh mục chi tiêu</h5>
                        <ul id="expense-categories" class="list-group">
                            <!-- Categories will be dynamically added here -->
                        </ul>
                    </div>
                </div>


                
            </div>
            <!-- Floating Reminders -->
<div id="floating-reminders" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; width: 300px;"></div>

            

            



            <!-- Chatbot Button and Panel -->
            <button id="chatbot-toggle" class="btn btn-primary" style="position: fixed; bottom: 20px; right: 20px; border-radius: 50%; width: 60px; height: 60px;">
                💬
            </button>
            <div id="chatbot-panel" class="card" style="position: fixed; bottom: 90px; right: 20px; width: 300px; display: none;">
                <div class="card-body">
                    <h5 class="card-title">Chatbot</h5>
                    <div id="chatbot" class="border p-3" style="height: 300px; overflow-y: auto;">
                        <!-- Chatbot conversation will appear here -->
                    </div>
                    <input type="text" id="chatbot-input" class="form-control mt-2" placeholder="Hỏi gì đó...">
                    <button class="btn btn-primary mt-2" id="chatbot-send">Gửi</button>
                </div>
            </div>
        </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const months = [
                    'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                    'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                ];

                let currentMonthIndex = new Date().getMonth();
                let currentYear = new Date().getFullYear();

                const totalIncomeElem = document.getElementById('total-income');
                const totalExpenseElem = document.getElementById('total-expense');
                const netBalanceElem = document.getElementById('net-balance');
                const warningElem = document.getElementById('over-budget-warning');
                const categoryChartCanvas = document.getElementById('category-chart').getContext('2d');
                const expenseCategoriesElem = document.getElementById('expense-categories');

                let categoryChart;

                const renderMonthHeader = () => {
                    const monthHeader = document.querySelector('.d-flex.justify-content-between.align-items-center');
                    monthHeader.innerHTML = `
            <span id="prev-month" style="cursor: pointer; font-size: 30px;">&lt;</span>
            <h2 style="margin: 0;">${months[currentMonthIndex]}, ${currentYear}</h2>
            <span id="next-month" style="cursor: pointer; font-size: 30px;">&gt;</span>
        `;

                    document.getElementById('prev-month').addEventListener('click', () => switchMonth(-1));
                    document.getElementById('next-month').addEventListener('click', () => switchMonth(1));
                };

                const loadTransactions = (monthIndex) => {
                    const transactions = JSON.parse(localStorage.getItem('transactions')) || [];
                    const filteredTransactions = transactions.filter(transaction => {
                        const transactionDate = new Date(transaction.date);
                        return (
                            transactionDate.getMonth() === monthIndex &&
                            transactionDate.getFullYear() === currentYear
                        );
                    });

                    let income = 0;
                    let expense = 0;
                    const categories = {};

                    filteredTransactions.forEach(transaction => {
                        const amount = typeof transaction.amount === 'string' ?
                            parseFloat(transaction.amount.replace(/,/g, '')) :
                            transaction.amount;

                        if (transaction.type === 'income') {
                            income += amount;
                            if (!categories[transaction.category]) categories[transaction.category] = {
                                income: 0,
                                expense: 0
                            };
                            categories[transaction.category].income += amount;
                        } else if (transaction.type === 'expense') {
                            expense += amount;
                            if (!categories[transaction.category]) categories[transaction.category] = {
                                income: 0,
                                expense: 0
                            };
                            categories[transaction.category].expense += amount;
                        }
                    });

                    return {
                        income,
                        expense,
                        categories,
                        filteredTransactions
                    };
                };

                const updateDashboard = (monthIndex) => {
                    const data = loadTransactions(monthIndex);

                    totalIncomeElem.textContent = `${data.income.toLocaleString()} VND`;
                    totalExpenseElem.textContent = `${data.expense.toLocaleString()} VND`;

                    const netBalance = data.income - data.expense;
                    netBalanceElem.textContent = `${netBalance.toLocaleString()} VND`;

                    if (data.income === 0 && data.expense === 0) {
                        warningElem.style.display = 'none';
                    } else if (netBalance < 0) {
                        warningElem.style.display = 'block';
                        warningElem.textContent = 'Chi tiêu đã vượt ngân sách!';
                        warningElem.classList.remove('text-warning');
                        warningElem.classList.add('text-danger');
                    } else if (netBalance <= data.income * 0.1) {
                        warningElem.style.display = 'block';
                        warningElem.textContent = 'Chi tiêu sắp vượt ngân sách!';
                        warningElem.classList.remove('text-danger');
                        warningElem.classList.add('text-warning');
                    } else {
                        warningElem.style.display = 'none';
                    }

                    updateExpenseList(data.filteredTransactions);
                    updateCategoryChart(data.categories);
                };

                const updateExpenseList = (transactions) => {
                    expenseCategoriesElem.innerHTML = '';

                    const expenses = transactions.filter(transaction => transaction.type === 'expense');

                    if (expenses.length === 0) {
                        expenseCategoriesElem.innerHTML = '<p class="text-muted">Không có giao dịch chi tiêu nào.</p>';
                        return;
                    }

                    expenses.forEach(expense => {
                        const expenseItem = document.createElement('div');
                        expenseItem.className = 'd-flex align-items-center justify-content-between border-bottom py-2';

                        expenseItem.innerHTML = `
                <div class="d-flex align-items-center">
                    <div class="icon rounded-circle bg-light text-center" style="width: 50px; height: 50px; font-size: 24px; line-height: 50px;">
                        ${expense.icon || expense.category.charAt(0).toUpperCase()}
                    </div>
                    <div class="ms-3">
                        <p class="mb-0"><strong>${expense.category}</strong></p>
                        <p class="mb-0 text-muted">${expense.description || 'Không có mô tả'}</p>
                    </div>
                </div>
                 <div class="text-end">
                    <p class="mb-0 text-danger"><strong>${expense.amount.toLocaleString()} VND</strong></p>
                </div>
            `;

                        expenseCategoriesElem.appendChild(expenseItem);
                    });
                };

                const updateCategoryChart = (categories) => {
                    if (categoryChart) {
                        categoryChart.destroy();
                    }

                    const labels = Object.keys(categories);
                    const incomeData = labels.map(label => categories[label].income || 0);
                    const expenseData = labels.map(label => categories[label].expense || 0);

                    const categoryChartData = {
                        labels,
                        datasets: [{
                                label: 'Thu nhập',
                                data: incomeData,
                                backgroundColor: '#36a2eb'
                            },
                            {
                                label: 'Chi tiêu',
                                data: expenseData,
                                backgroundColor: '#ff6384'
                            }
                        ]
                    };

                    categoryChart = new Chart(categoryChartCanvas, {
                        type: 'bar',
                        data: categoryChartData,
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                };

                const switchMonth = (direction) => {
                    currentMonthIndex += direction;
                    if (currentMonthIndex < 0) {
                        currentMonthIndex = 11;
                        currentYear -= 1;
                    } else if (currentMonthIndex > 11) {
                        currentMonthIndex = 0;
                        currentYear += 1;
                    }

                    renderMonthHeader();
                    updateDashboard(currentMonthIndex);
                };

                document.getElementById('export-pdf').addEventListener('click', () => {
                    const data = loadTransactions(currentMonthIndex).filteredTransactions;

                    if (data.length === 0) {
                        alert('Không có dữ liệu để xuất!');
                        return;
                    }

                    const exportData = data.map((transaction, index) => ({
                        'STT': index + 1,
                        'Danh mục': transaction.category,
                        'Số tiền (VND)': transaction.amount.toLocaleString(),
                        'Loại': transaction.type,
                        'Ngày': transaction.date
                    }));

                    const worksheet = XLSX.utils.json_to_sheet(exportData);
                    const workbook = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(workbook, worksheet, `Tháng ${currentMonthIndex + 1}`);
                    XLSX.writeFile(workbook, `Chi_tieu_Thang_${currentMonthIndex + 1}.xlsx`);
                });

                renderMonthHeader();
                updateDashboard(currentMonthIndex);
            });
            document.addEventListener("DOMContentLoaded", () => {
    const renderFloatingReminders = () => {
        const reminders = JSON.parse(localStorage.getItem("reminders")) || [];
        const reminderContainer = document.getElementById("floating-reminders");
        const today = new Date();
        const todayString = today.toISOString().split("T")[0]; // YYYY-MM-DD

        // Làm sạch danh sách trước khi thêm mới
        reminderContainer.innerHTML = "";

        if (reminders.length === 0) {
            return; // Không có nhắc nhở
        }

        // Lọc nhắc nhở hợp lệ cho hôm nay
        const todayReminders = reminders.filter((reminder) => {
            const reminderDate = new Date(reminder.date);
            const repeat = reminder.repeat;

            if (reminder.date === todayString) {
                return true;
            } else if (repeat === "hang-ngay") {
                return true;
            } else if (repeat === "hang-tuan" && today.getDay() === reminderDate.getDay()) {
                return true;
            } else if (repeat === "hang-thang" && today.getDate() === reminderDate.getDate()) {
                return true;
            }
            return false;
        });

        if (todayReminders.length === 0) {
            return; // Không có nhắc nhở hôm nay
        }

        // Hiển thị tất cả nhắc nhở
        todayReminders.forEach((reminder, index) => {
            const reminderCard = document.createElement("div");
            reminderCard.className = "notification p-3 mb-2";
            reminderCard.style.backgroundColor = "#4e54c8";
            reminderCard.style.color = "white";
            reminderCard.style.borderRadius = "8px";
            reminderCard.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.2)";
            reminderCard.style.transition = "opacity 0.3s";

            reminderCard.innerHTML = `
                <span>Nhắc nhở: ${reminder.title} vào hôm nay.</span>
            `;

            reminderContainer.appendChild(reminderCard);

            // Ẩn nhắc nhở lần lượt sau khoảng thời gian
            setTimeout(() => {
                reminderCard.style.opacity = "0"; // Hiệu ứng mờ dần
                setTimeout(() => {
                    reminderCard.remove(); // Xóa khỏi DOM sau khi ẩn
                }, 300); // Đợi hiệu ứng hoàn tất
            }, 5000 * (index + 1)); // Tăng dần thời gian ẩn (5 giây cho mỗi nhắc nhở)
        });
    };

    // Hiển thị nhắc nhở nổi khi tải trang
    renderFloatingReminders();
});


            document.addEventListener("DOMContentLoaded", () => {
    // Hiển thị tên người dùng
    const userNameElem = document.getElementById("user-name");
    const currentUser = localStorage.getItem("currentUser");

    if (currentUser) {
        userNameElem.textContent = currentUser;
    } else {
        userNameElem.textContent = "Khách";
    }

    // Hiển thị và ẩn menu dropdown
    const userMenu = document.getElementById("user-menu");
    const dropdownMenu = document.getElementById("dropdown-menu");

    userMenu.addEventListener("click", () => {
        const isVisible = dropdownMenu.style.display === "block";
        dropdownMenu.style.display = isVisible ? "none" : "block";
    });

    document.addEventListener("click", (event) => {
        if (!userMenu.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = "none";
        }
    });
});

// Đăng xuất
function logout() {
    localStorage.removeItem("currentUser");
    alert("Bạn đã đăng xuất!");
    window.location.href = "login.blade.php";
}

        </script>

    </body>

    </html>
