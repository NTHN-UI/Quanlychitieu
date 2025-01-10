<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Ngân Sách</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f9fafc, #e8ecf3);
            margin: 0;
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
        #prev-budget-month,
            #next-budget-month {
                font-size: 30px;
                color: #4e54c8;
                cursor: pointer;
                transition: color 0.3s, transform 0.3s;
            }

            #prev-budget-month:hover,
            #next-budget-month:hover {
                color: #3b3ccf;
                transform: scale(1.2);
            }

          
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
                <li class="nav-item"><a href="expense.blade.php" class="nav-link">Thu chi</a></li>
                <li class="nav-item"><a href="transaction.blade.php" class="nav-link">Sổ giao dịch</a></li>
                <li class="nav-item"><a href="remind.blade.php" class="nav-link">Nhắc nhở</a></li>
                <li class="nav-item"><a href="bugdget.blade.php" class="nav-link active">Ngân sách</a></li>
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
    <!-- Main Content -->
    <div class="main-content">
        <!-- Budget Section -->
         <div class="container">
         <div class="month-navigation d-flex justify-content-between align-items-center mb-4">
    <span id="prev-budget-month">&lt;</span>
    <h2 id="current-budget-month">Tháng 1, 2025</h2>
    <span id="next-budget-month">&gt;</span>
</div>

         <section id="budget-section">
            <h2 class="section-title">Quản Lý Ngân Sách</h2>
            <div class="card mb-4">
                <div class="card-body">
                    <form id="budget-form">
                        <div class="mb-3">
                            <label for="budget-category" class="form-label">Danh mục</label>
                            <select class="form-select" id="budget-category" required>
                                        <option value="" selected disabled>Chọn danh mục</option>
                                        <option value="🍔 Ăn uống">🍔 Ăn uống</option>
                                        <option value="🛍️ Mua sắm">🛍️ Mua sắm</option>
                                        <option value="🎮 Giải trí">🎮 Giải trí</option>
                                        <option value="📚 Học tập">📚 Học tập</option>
                                        <option value="🛒 Chợ, siêu thị">🛒 Chợ, siêu thị</option>
                                        <option value="🚗 Di chuyển">🚗 Di chuyển</option>
                                        <option value="💅 Làm đẹp">💅 Làm đẹp</option>
                                        <option value="❤️ Sức khỏe">❤️ Sức khỏe</option>
                                        <option value="🎁 Từ thiện">🎁 Từ thiện</option>
                                        <option value="💳 Trả nợ">💳 Trả nợ</option>
                                        <option value="🧾 Hóa đơn">🧾 Hóa đơn</option>
                                        <option value="🏠 Nhà cửa">🏠 Nhà cửa</option>
                                        <option value="👨‍👩‍👧‍👦 Người thân">👨‍👩‍👧‍👦 Người thân</option>

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
            <form id="goal-form">
                <div class="mb-3">
                    <label for="goal-name" class="form-label">Tên mục tiêu</label>
                    <input type="text" class="form-control" id="goal-name" placeholder="VD: Mua nhà, Du lịch..." required>
                </div>
                <div class="mb-3">
                    <label for="goal-amount" class="form-label">Số tiền cần tiết kiệm</label>
                    <input type="text" class="form-control" id="goal-amount" placeholder="Nhập số tiền " required>
                </div>
                <div class="mb-3">
                    <label for="goal-savings" class="form-label">Số tiền tiết kiệm hàng tháng</label>
                    <input type="text" class="form-control" id="goal-savings" placeholder="Nhập số tiền hàng tháng" required>
                </div>
                <button type="submit" class="btn btn-primary">Thêm Mục Tiêu</button>
            </form>
        </div>
    </div>

    <!-- Goals Display -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Danh Sách Mục Tiêu</h5>
            <ul id="goal-list" class="list-group">
                <!-- Goal items will be added dynamically -->
            </ul>
        </div>
    </div>
</section>
         </div>
    
    </div>

    <script>
        
        const budgetForm = document.getElementById('budget-form');
const budgetList = document.getElementById('budget-list');
const budgetAlert = document.getElementById('budget-alert');

// Danh sách các icon tương ứng với các danh mục
const categoryIcons = {
    "🍔|Ăn uống": "🍔",
    "🛍️|Mua sắm": "🛍️",
    "🎮|Giải trí": "🎮",
    "📚|Học tập": "📚",
    "🛒|Chợ, siêu thị": "🛒",
    "🚗|Di chuyển": "🚗",
    "💅|Làm đẹp": "💅",
    "❤️|Sức khỏe": "❤️",
    "🎁|Từ thiện": "🎁",
    "💳|Trả nợ": "💳",
    "🧾|Hóa đơn": "🧾",
    "🏠|Nhà cửa": "🏠",
    "👨‍👩‍👧‍👦|Người thân": "👨‍👩‍👧‍👦",
};

// Dữ liệu tháng
const months = [
    "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6",
    "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
];

let currentMonthIndex = new Date().getMonth() + 1; // Tháng bắt đầu từ 1
let currentYear = new Date().getFullYear();

// Hàm hiển thị tháng hiện tại
const renderMonthHeader = () => {
    const monthHeader = document.getElementById('current-budget-month');
    monthHeader.textContent = `${months[currentMonthIndex - 1]}, ${currentYear}`;
};



// Gắn sự kiện chuyển tháng
document.getElementById('prev-budget-month').addEventListener('click', () => switchMonth(-1));
document.getElementById('next-budget-month').addEventListener('click', () => switchMonth(1));

// Hàm định dạng số tiền
const formatCurrency = (amount) => {
    return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');  // Thêm dấu phẩy ở mỗi ba chữ số
};

const formatCurrencyInput = (input) => {
    input.addEventListener('input', (e) => {
        let value = e.target.value.replace(/,/g, ''); // Loại bỏ dấu phẩy trước
        if (!isNaN(value)) {
            e.target.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Thêm dấu phẩy
        }
    });
};

const budgetAmountInput = document.getElementById('budget-amount');
formatCurrencyInput(budgetAmountInput);

const saveBudgetToLocalStorage = (category, formattedAmount) => {
    const budgets = JSON.parse(localStorage.getItem('budgets')) || {};
    const monthKey = `${currentMonthIndex}-${currentYear}`; // Khóa xác định tháng hiện tại
    budgets[monthKey] = budgets[monthKey] || {};

    // Loại bỏ dấu '|' trước khi lưu
    const cleanedCategory = category.replace('|', ' '); 
    budgets[monthKey][cleanedCategory] = formattedAmount;

    // Lưu lại vào localStorage
    localStorage.setItem('budgets', JSON.stringify(budgets));
};


const loadBudgetsFromLocalStorage = () => {
    const budgets = JSON.parse(localStorage.getItem('budgets')) || {};
    const monthKey = `${currentMonthIndex}-${currentYear}`; // Lấy khóa tháng hiện tại
    const monthBudgets = budgets[monthKey] || {}; // Chỉ lấy ngân sách của tháng hiện tại

    budgetList.innerHTML = '';
    for (const [category, amount] of Object.entries(monthBudgets)) {
        const li = document.createElement('li');
        li.className = 'list-group-item d-flex justify-content-between align-items-center';
        li.innerHTML = `<span>${category}</span><span>${formatCurrency(amount)} VND</span>`;
        budgetList.appendChild(li);
    }

    checkBudgetAndDisplayAlert();
};


const checkBudgetAndDisplayAlert = () => {
    const budgets = JSON.parse(localStorage.getItem('budgets')) || {};
    const categoryExpenses = JSON.parse(localStorage.getItem('categoryExpenses')) || {};
    const monthKey = `${currentMonthIndex}-${currentYear}`;
    const monthBudgets = budgets[monthKey] || {};

    let alertMessage = '';
    for (const [category, budgetAmount] of Object.entries(monthBudgets)) {
        const expenseAmount = parseFloat(categoryExpenses[monthKey]?.[category]?.replace(/,/g, '') || 0);
        if (expenseAmount > parseFloat(budgetAmount.replace(/,/g, ''))) {
            alertMessage += `<p>${category} vượt ngân sách! 
                Chi tiêu: <strong>${formatCurrency(expenseAmount)}</strong> VND, 
                Ngân sách: <strong>${formatCurrency(budgetAmount)}</strong> VND.</p>`;
        }
    }

    budgetAlert.innerHTML = alertMessage
        ? `<div class="alert alert-danger">${alertMessage}</div>`
        : '';
};



document.addEventListener('DOMContentLoaded', () => {
    renderMonthHeader();
    loadBudgetsFromLocalStorage();
    checkBudgetAndDisplayAlert();
});

budgetForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const category = document.getElementById('budget-category').value;
    const amount = document.getElementById('budget-amount').value;
    saveBudgetToLocalStorage(category, amount);
    loadBudgetsFromLocalStorage();
    budgetForm.reset();
});
const getLastMonthKey = () => {
    let lastMonth = currentMonthIndex - 1;
    let lastYear = currentYear;
    if (lastMonth < 1) {
        lastMonth = 12;
        lastYear -= 1;
    }
    return `${lastMonth}-${lastYear}`;
};
const generateForecast = () => {
    const categoryExpenses = JSON.parse(localStorage.getItem('categoryExpenses')) || {};
    const lastMonthKey = getLastMonthKey(); // Lấy dữ liệu tháng trước
    const lastMonthExpenses = categoryExpenses[lastMonthKey] || {};

    const forecastList = document.getElementById('forecast-list');
    forecastList.innerHTML = '';

    for (const [category, amount] of Object.entries(lastMonthExpenses)) {
        const expenseAmount = parseFloat(amount.replace(/,/g, '')) || 0;

        // Tùy chỉnh công thức dự báo (ở đây giữ nguyên mức chi tiêu tháng trước)
        const forecastAmount = expenseAmount; 

        const li = document.createElement('li');
        li.className = 'list-group-item d-flex justify-content-between align-items-center';
        li.innerHTML = `<span>${category}</span><span>${formatCurrency(forecastAmount)} VND</span>`;
        forecastList.appendChild(li);
    }
};

const addCustomCategoriesToDropdown = () => {
    const budgetCategoryDropdown = document.getElementById('budget-category');
    const savedCategories = JSON.parse(localStorage.getItem('customCategories')) || [];

    // Lọc ra các danh mục đã cố định để tránh trùng lặp
    const existingCategories = Array.from(budgetCategoryDropdown.options).map(option => option.textContent.trim());

    // Thêm các danh mục từ `localStorage`
    savedCategories.forEach(category => {
        if (category.type === 'expense') { // Chỉ thêm danh mục chi tiêu
            const categoryText = `${category.icon} ${category.name}`;
            if (!existingCategories.includes(categoryText)) { // Kiểm tra xem đã tồn tại hay chưa
                const option = document.createElement('option');
                option.value = `${category.icon}|${category.name}`;
                option.textContent = categoryText;
                budgetCategoryDropdown.appendChild(option);
            }
        }
    });
};

const parseCurrency = (formattedAmount) => {
    return parseFloat(formattedAmount.replace(/,/g, '')); // Loại bỏ dấu phẩy và chuyển thành số
};


const goalForm = document.getElementById('goal-form');
    const goalList = document.getElementById('goal-list');


    formatCurrencyInput(document.getElementById('goal-amount'));
    formatCurrencyInput(document.getElementById('goal-savings'));

    const saveGoalToLocalStorage = (goal) => {
    const monthKey = `${currentMonthIndex}-${currentYear}`;
    const goals = JSON.parse(localStorage.getItem(`goals-${monthKey}`)) || [];
    
    // Định dạng số tiền trước khi lưu
    goal.targetAmount = formatCurrency(goal.targetAmount);
    goal.saved = formatCurrency(goal.saved);
    goal.monthlySavings = formatCurrency(goal.monthlySavings);

    goals.push(goal);
    localStorage.setItem(`goals-${monthKey}`, JSON.stringify(goals));
};


// Hàm lưu trạng thái dòng tiền vào localStorage
const saveMonthlySavings = (monthKey, netBalance) => {
    const monthlySavings = JSON.parse(localStorage.getItem('monthlySavings')) || {};
    const formattedBalance = formatCurrency(netBalance); // Định dạng trước khi lưu
    monthlySavings[monthKey] = formattedBalance;
    localStorage.setItem('monthlySavings', JSON.stringify(monthlySavings));
};


// Hàm lấy trạng thái dòng tiền hiện tại từ localStorage
const getMonthlySavings = (monthKey) => {
    const monthlySavings = JSON.parse(localStorage.getItem('monthlySavings')) || {};
    return monthlySavings[monthKey] || '0'; // Trả về chuỗi định dạng nếu có, nếu không trả về '0'
};

const loadGoalsFromLocalStorage = () => {
    const monthKey = `${currentMonthIndex}-${currentYear}`;
    const goals = JSON.parse(localStorage.getItem(`goals-${monthKey}`)) || [];
    goalList.innerHTML = '';

    goals.forEach((goal, index) => {
        const progressPercent = Math.min((parseCurrency(goal.saved) / parseCurrency(goal.targetAmount)) * 100, 100).toFixed(2);

        const li = document.createElement('li');
        li.className = 'list-group-item';

        li.innerHTML = `
            <div>
                <strong>${goal.name}</strong>
                <p>Mục tiêu: ${goal.targetAmount} VND</p>
                <p>Đã tiết kiệm: ${goal.saved} VND</p>
                <div class="progress mb-2">
                    <div class="progress-bar bg-success" role="progressbar" style="width: ${progressPercent}%;" 
                         aria-valuenow="${progressPercent}" aria-valuemin="0" aria-valuemax="100">
                         ${progressPercent}%
                    </div>
                </div>
            </div>
            <button class="btn btn-danger btn-sm" onclick="removeGoal(${index})">Xóa</button>
        `;

        goalList.appendChild(li);
    });
};



const removeGoal = (index) => {
    const monthKey = `${currentMonthIndex}-${currentYear}`;
    const goals = JSON.parse(localStorage.getItem(`goals-${monthKey}`)) || [];
    goals.splice(index, 1);
    localStorage.setItem(`goals-${monthKey}`, JSON.stringify(goals));
    loadGoalsFromLocalStorage();
};

goalForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const name = document.getElementById('goal-name').value;
    const targetAmount = parseFloat(document.getElementById('goal-amount').value.replace(/,/g, ''));
    const monthlySavings = parseFloat(document.getElementById('goal-savings').value.replace(/,/g, ''));

    const goal = {
        name,
        targetAmount,
        saved: 0, // Số tiền đã tiết kiệm trong tháng
        monthlySavings
    };

    saveGoalToLocalStorage(goal);
    loadGoalsFromLocalStorage();
    goalForm.reset();
});
document.addEventListener('DOMContentLoaded', () => {
    loadGoalsFromLocalStorage();
});

    document.addEventListener('DOMContentLoaded', loadGoalsFromLocalStorage);
    const calculateMonthlySavings = () => {
    const transactions = JSON.parse(localStorage.getItem('transactions')) || [];
    const monthlySavings = {};

    transactions.forEach(transaction => {
        const transactionDate = new Date(transaction.date);
        const monthKey = `${transactionDate.getMonth() + 1}-${transactionDate.getFullYear()}`;
        const amount = parseFloat(transaction.amount.replace(/,/g, '')); // Loại bỏ dấu phẩy trước khi tính

        if (!monthlySavings[monthKey]) {
            monthlySavings[monthKey] = 0;
        }

        if (transaction.type === 'income') {
            monthlySavings[monthKey] += amount;
        } else if (transaction.type === 'expense') {
            monthlySavings[monthKey] -= amount;
        }
    });

    for (const [monthKey, netBalance] of Object.entries(monthlySavings)) {
        saveMonthlySavings(monthKey, netBalance); // Lưu với định dạng
    }

    const currentMonthKey = `${currentMonthIndex}-${currentYear}`;
    return getMonthlySavings(currentMonthKey); // Trả về số tiền đã định dạng
};


const displaySavings = () => {
    const monthKey = `${currentMonthIndex}-${currentYear}`;
    const savings = getMonthlySavings(monthKey); // Lấy trực tiếp chuỗi đã định dạng
    const savingsElem = document.getElementById('savings-display');

    if (savingsElem) {
        savingsElem.textContent = `${savings} VND`; // Hiển thị trực tiếp
    }
};







// Gọi khi tải trang hoặc khi chuyển tháng
document.addEventListener('DOMContentLoaded', () => {
    const currentMonthKey = `${currentMonthIndex}-${currentYear}`;
    calculateMonthlySavings(); // Tính toán dòng tiền
    updateGoalProgressWithSavings(); // Cập nhật tiến độ mục tiêu nếu có thay đổi
    displaySavings(); // Hiển thị dòng tiền
    loadGoalsFromLocalStorage(); // Hiển thị mục tiêu
});
const updateGoalProgressWithSavings = () => {
    const monthKey = `${currentMonthIndex}-${currentYear}`;
    const goals = JSON.parse(localStorage.getItem(`goals-${monthKey}`)) || [];
    const netBalance = parseCurrency(getMonthlySavings(monthKey)); // Lấy số tiền từ localStorage

    goals.forEach(goal => {
        // Không cộng dồn, chỉ cập nhật đúng giá trị từ monthlySavings
        goal.saved = formatCurrency(netBalance); // Lưu lại định dạng số tiền đã tiết kiệm
    });

    localStorage.setItem(`goals-${monthKey}`, JSON.stringify(goals));
    loadGoalsFromLocalStorage(); // Hiển thị lại danh sách mục tiêu
};






const addTransaction = (transaction) => {
    const transactions = JSON.parse(localStorage.getItem('transactions')) || [];
    transactions.push(transaction);
    localStorage.setItem('transactions', JSON.stringify(transactions));

    calculateMonthlySavings(); // Cập nhật dòng tiền
    updateGoalProgressWithSavings(); // Cập nhật mục tiêu tiết kiệm
    displaySavings(); // Cập nhật hiển thị dòng tiền
};




// Gọi `checkBudgetAndDisplayAlert` khi cần
document.addEventListener('DOMContentLoaded', () => {
    renderMonthHeader();
    calculateMonthlySavings(); // Tính toán và lưu dòng tiền
    displaySavings(); // Hiển thị dòng tiền
    loadGoalsFromLocalStorage(); // Hiển thị mục tiêu
    updateGoalProgressWithSavings(); // Cập nhật tiến độ mục tiêu
    loadBudgetsFromLocalStorage(); // Hiển thị ngân sách
    checkBudgetAndDisplayAlert(); // Hiển thị cảnh báo
});

const switchMonth = (direction) => {
    currentMonthIndex += direction;
    if (currentMonthIndex < 1) {
        currentMonthIndex = 12;
        currentYear -= 1;
    } else if (currentMonthIndex > 12) {
        currentMonthIndex = 1;
        currentYear += 1;
    }

    renderMonthHeader(); // Cập nhật tiêu đề tháng
    loadBudgetsFromLocalStorage(); // Tải ngân sách cho tháng mới
    checkBudgetAndDisplayAlert(); // Cập nhật cảnh báo
    generateForecast(); // Cập nhật dự báo
    loadGoalsFromLocalStorage(); // Hiển thị mục tiêu của tháng
    displaySavings(); // Hiển thị dòng tiền của tháng
    updateGoalProgressWithSavings(); // Cập nhật tiến độ tiết kiệm
};

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
