<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Ngân Sách</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f9fafc, #e8ecf3);
            margin: 0;
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

        .btn-primary {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            border: none;
            font-weight: bold;
        }

        .section-title {
            font-size: 1.5rem;
            color: #4e54c8;
            margin-bottom: 1rem;
        }

        .progress {
            height: 20px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <!-- Sidebar Navigation -->
    <nav>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="dashboard.blade.php" class="nav-link">Dashboard</a></li>
                <li class="nav-item"><a href="expense.blade.php" class="nav-link">Chi tiêu</a></li>
                <li class="nav-item"><a href="transaction.blade.php" class="nav-link">Sổ giao dịch</a></li>
                <li class="nav-item"><a href="remind.blade.php" class="nav-link">Nhắc nhở</a></li>
                <li class="nav-item"><a href="bugdget.blade.php" class="nav-link active">Ngân sách</a></li>
                <li class="nav-item"><a href="setting.blade.php" class="nav-link">Cài đặt</a></li>
            </ul>
        </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Budget Section -->
         <div class="container">
         <section id="budget-section">
            <h2 class="section-title">Quản Lý Ngân Sách</h2>
            <div class="card mb-4">
                <div class="card-body">
                    <form id="budget-form">
                        <div class="mb-3">
                            <label for="budget-category" class="form-label">Danh mục</label>
                            <select class="form-select" id="budget-category" required>
                                        <option value="" selected disabled>Chọn danh mục</option>
                                        <option value="🍔|Ăn uống">🍔 Ăn uống</option>
                                        <option value="🛍️|Mua sắm">🛍️ Mua sắm</option>
                                        <option value="🎮|Giải trí">🎮 Giải trí</option>
                                        <option value="📚|Học tập">📚 Học tập</option>
                                        <option value="🛒|Chợ, siêu thị">🛒 Chợ, siêu thị</option>
                                        <option value="🚗|Di chuyển">🚗 Di chuyển</option>
                                        <option value="💅|Làm đẹp">💅 Làm đẹp</option>
                                        <option value="❤️|Sức khỏe">❤️ Sức khỏe</option>
                                        <option value="🎁|Từ thiện">🎁 Từ thiện</option>
                                        <option value="💳|Trả nợ">💳 Trả nợ</option>
                                        <option value="🧾|Hóa đơn">🧾 Hóa đơn</option>
                                        <option value="🏠|Nhà cửa">🏠 Nhà cửa</option>
                                        <option value="👨‍👩‍👧‍👦|Người thân">👨‍👩‍👧‍👦 Người thân</option>

                                    </select>
                        </div>
                        <div class="mb-3">
                            <label for="budget-amount" class="form-label">Số tiền</label>
                            <input type="text" class="form-control" id="budget-amount" placeholder="Nhập số tiền" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu Ngân Sách</button>
                    </form>
                </div>
            </div>

            <!-- Budget Display -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Đặt ngân sách</h5>
                    <ul id="budget-list" class="list-group">

                    </ul>
                    <div id="budget-alert" class="mt-3"></div> <!-- Nơi hiển thị cảnh báo -->
                </div>
            </div>
        </section>

        <!-- Forecast Section -->
        <section id="forecast-section" class="mt-5">
            <h2 class="section-title">Dự Báo Chi Tiêu</h2>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dự Báo Hàng Tháng</h5>
                    <ul id="forecast-list" class="list-group">
                    </ul>
                </div>
            </div>
        </section>

        <!-- Goals Section -->
        <section id="goal-section" class="mt-5">
            <h2 class="section-title">Mục Tiêu Tài Chính</h2>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Thiết Lập Mục Tiêu</h5>
                    <form id="goal-form">
                        <div class="mb-3">
                            <label for="goal-name" class="form-label">Tên Mục Tiêu</label>
                            <input type="text" class="form-control" id="goal-name" placeholder="Ví dụ: Mua nhà" required>
                        </div>
                        <div class="mb-3">
                            <label for="goal-amount" class="form-label">Số Tiền (VND)</label>
                            <input type="number" class="form-control" id="goal-amount" placeholder="Nhập số tiền" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu Mục Tiêu</button>
                    </form>
                </div>
            </div>

            <!-- Goals Display -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Danh Sách Mục Tiêu</h5>
                    <ul id="goal-list" class="list-group">
                    </ul>
                </div>
            </div>
        </section>
         </div>
    
    </div>

    <script>
        // Budget Management
const budgetForm = document.getElementById('budget-form');
const budgetList = document.getElementById('budget-list');

// Hàm định dạng số tiền với dấu phẩy khi nhập
const formatCurrencyInput = (input) => {
    input.addEventListener('input', (e) => {
        let value = e.target.value.replace(/,/g, ''); // Loại bỏ dấu phẩy trước
        if (!isNaN(value)) {
            e.target.value = parseInt(value, 10).toLocaleString('en-US'); // Thêm dấu phẩy
        }
    });
};

// Lưu ngân sách với định dạng chuỗi có dấu phẩy
const saveBudgetToLocalStorage = (category, formattedAmount) => {
    const budgets = JSON.parse(localStorage.getItem('budgets')) || {};
    budgets[category] = formattedAmount; // Lưu dữ liệu đã định dạng
    localStorage.setItem('budgets', JSON.stringify(budgets));
};

// Tải ngân sách từ LocalStorage
const loadBudgetsFromLocalStorage = () => {
    const budgets = JSON.parse(localStorage.getItem('budgets')) || {};
    budgetList.innerHTML = '';
    for (const [category, formattedAmount] of Object.entries(budgets)) {
        const li = document.createElement('li');
        li.className = 'list-group-item';
        li.textContent = `${category.split('|')[1]}: ${formattedAmount} VND`;
        budgetList.appendChild(li);
    }
};

budgetForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const category = document.getElementById('budget-category').value;
    const amount = document.getElementById('budget-amount').value; // Dữ liệu đã được định dạng
    saveBudgetToLocalStorage(category, amount);
    loadBudgetsFromLocalStorage();
    budgetForm.reset();
});

// Định dạng trường nhập số tiền
const budgetAmountInput = document.getElementById('budget-amount');
formatCurrencyInput(budgetAmountInput);

// Load ngân sách khi tải trang
loadBudgetsFromLocalStorage();

// Forecast Spending
const forecastList = document.getElementById('forecast-list');

const loadForecastFromLocalStorage = () => {
    const transactions = JSON.parse(localStorage.getItem('transactions')) || [];
    const forecast = {};

    transactions.forEach(tx => {
        if (tx.type === 'expense' && tx.amount) {
            const amount = parseFloat(String(tx.amount).replace(/,/g, '')) || 0; // Đảm bảo tx.amount là chuỗi
            forecast[tx.category] = (forecast[tx.category] || 0) + amount;
        }
    });

    forecastList.innerHTML = '';
    for (const [category, total] of Object.entries(forecast)) {
        const average = (total / 12).toFixed(2).toLocaleString('en-US');
        const li = document.createElement('li');
        li.className = 'list-group-item';
        li.textContent = `${category.split('|')[1]}: Trung bình ${average} VND/tháng`;
        forecastList.appendChild(li);
    }
};


loadForecastFromLocalStorage();

// Goals Management
const goalForm = document.getElementById('goal-form');
const goalList = document.getElementById('goal-list');

const saveGoalToLocalStorage = (name, formattedAmount) => {
    const goals = JSON.parse(localStorage.getItem('goals')) || [];
    goals.push({ name, amount: formattedAmount }); // Lưu dữ liệu đã định dạng
    localStorage.setItem('goals', JSON.stringify(goals));
};

const loadGoalsFromLocalStorage = () => {
    const goals = JSON.parse(localStorage.getItem('goals')) || [];
    goalList.innerHTML = '';
    goals.forEach(goal => {
        const li = document.createElement('li');
        li.className = 'list-group-item';
        li.textContent = `${goal.name}: ${goal.amount} VND`;
        goalList.appendChild(li);
    });
};

goalForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const name = document.getElementById('goal-name').value;
    const amount = document.getElementById('goal-amount').value; // Dữ liệu đã được định dạng
    saveGoalToLocalStorage(name, amount);
    loadGoalsFromLocalStorage();
    goalForm.reset();
});

// Định dạng trường nhập số tiền cho mục tiêu
const goalAmountInput = document.getElementById('goal-amount');
formatCurrencyInput(goalAmountInput);

// Load mục tiêu khi tải trang
loadGoalsFromLocalStorage();

const calculateTotalExpenses = () => {
    const transactions = JSON.parse(localStorage.getItem('transactions')) || [];
    const categoryExpenses = {};

    // Duyệt qua từng giao dịch và tính tổng chi tiêu theo danh mục
    transactions.forEach(tx => {
        if (tx.type === 'expense' && tx.amount) {
            const amount = parseFloat(String(tx.amount).replace(/,/g, '')) || 0; // Đảm bảo tx.amount là chuỗi
            const category = tx.category || 'Khác'; // Đặt tên mặc định nếu không có danh mục
            categoryExpenses[category] = (categoryExpenses[category] || 0) + amount;
        }
    });

    return categoryExpenses;
};


const checkBudgetAndDisplayAlert = () => {
    const budgets = JSON.parse(localStorage.getItem('budgets')) || {};
    const totalExpenses = calculateTotalExpenses();
    let alertMessage = '';

    // So sánh từng danh mục
    for (const [category, expense] of Object.entries(totalExpenses)) {
        const budgetAmount = parseFloat((budgets[category] || '0').replace(/,/g, '')) || 0;
        if (expense > budgetAmount) {
            const categoryName = category.split('|')[1] || 'Danh mục không xác định';
            alertMessage = `Chi tiêu ${categoryName} vượt ngân sách.`;
            break; // Dừng kiểm tra sau khi tìm thấy một danh mục vượt ngân sách
        }
    }

    // Hiển thị thông báo một lần duy nhất
    const budgetAlert = document.getElementById('budget-alert');
    if (budgetAlert) {
        budgetAlert.innerHTML = alertMessage || `Tất cả chi tiêu đều trong ngân sách!`;
    } else {
        console.error('Không tìm thấy phần tử có ID "budget-alert".');
    }
};



    // Gọi kiểm tra ngân sách khi tải trang
    document.addEventListener('DOMContentLoaded', () => {
        checkBudgetAndDisplayAlert();
    });
    const cleanTransactions = () => {
    let transactions = JSON.parse(localStorage.getItem('transactions')) || [];
    transactions = transactions.map(tx => {
        if (typeof tx.amount !== 'string') {
            tx.amount = String(tx.amount || '0'); // Chuyển đổi amount thành chuỗi
        }
        return tx;
    });
    localStorage.setItem('transactions', JSON.stringify(transactions));
};

// Gọi hàm làm sạch trước khi sử dụng
cleanTransactions();
const saveTransactionToLocalStorage = (transaction) => {
    const transactions = JSON.parse(localStorage.getItem('transactions')) || [];
    transaction.amount = String(transaction.amount || '0'); // Đảm bảo amount là chuỗi
    transactions.push(transaction);
    localStorage.setItem('transactions', JSON.stringify(transactions));
};


    // Kiểm tra ngân sách sau khi lưu ngân sách mới
    document.getElementById('budget-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const category = document.getElementById('budget-category').value;
        const amount = document.getElementById('budget-amount').value; // Lấy dữ liệu ngân sách mới
        saveBudgetToLocalStorage(category, amount); // Lưu ngân sách vào LocalStorage
        loadBudgetsFromLocalStorage(); // Cập nhật danh sách ngân sách
        checkBudgetAndDisplayAlert(); // Cập nhật cảnh báo
        budgetForm.reset(); // Reset form
    });

    </script>
</body>

</html>
