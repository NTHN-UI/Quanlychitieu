<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Finance Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
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

        .transaction-day {
            font-size: 1rem;
            /* Kích thước chữ */
            font-weight: bold;
            /* Chữ đậm */
            color: #ffffff;
            /* Màu chữ trắng */
            background-color: #4e54c8;
            /* Nền tím xanh */
            margin-top: 20px;
            padding: 10px 20px;
            /* Thêm khoảng cách */
            border-radius: 25px;
            /* Bo tròn đầy đặn */
            display: inline-block;
            text-align: center;
            /* Căn giữa */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Hiệu ứng đổ bóng */
            transition: transform 0.2s, box-shadow 0.2s;
            /* Hiệu ứng hover */
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .transaction-entry {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s;
        }


        .transaction-entry .icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f1f3f5;
            border-radius: 50%;
            font-size: 24px;
            margin-right: 15px;
        }

        .transaction-entry .details {
            flex-grow: 1;
            text-align: left;
        }

        .transaction-entry .details p {
            margin: 0;
        }

        .transaction-entry .details .category {
            font-size: 0.9em;
            color: #6c757d;
        }

        .transaction-entry .amount {
            font-weight: bold;
            color: #007bff;
            text-align: right;
            min-width: 100px;
        }

        .no-transactions {
            text-align: center;
            font-style: italic;
            color: #aaa;
            margin: 20px 0;
        }

        .transactions-list {
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, #f8f9fc, #e9eff5);
        }
    </style>
</head>

<body>

    <nav>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="dashboard.blade.php" class="nav-link">Dashboard</a></li>
            <li class="nav-item"><a href="expense.blade.php" class="nav-link">Chi tiêu</a></li>
            <li class="nav-item"><a href="transaction.blade.php" class="nav-link active">Sổ giao dịch</a></li>
            <li class="nav-item"><a href="remind.blade.php" class="nav-link">Nhắc nhở</a></li>
            <li class="nav-item"><a href="bugdget.blade.php" class="nav-link ">Ngân sách</a></li>
            <li class="nav-item"><a href="setting.blade.php" class="nav-link">Cài đặt</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <!-- Month Navigation -->
            <div class="month-navigation d-flex justify-content-between align-items-center mb-4">
                <span id="prev-month">&lt;</span>
                <h2 id="current-month">Tháng 12, 2024</h2>
                <span id="next-month">&gt;</span>
            </div>

            <!-- Transactions List -->
            <div class="transactions-list" id="transactions-list">
                <!-- Transactions will be dynamically added here -->
            </div>
            <button id="export-sql" style="margin-top: 10px;" class="btn btn-primary">Xuất Dữ Liệu </button>
        </div>
        

    </div>


    <script>
        const months = [
    "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6",
    "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
];

let currentMonthIndex = new Date().getMonth() + 1; // Tháng bắt đầu từ 1
let currentYear = new Date().getFullYear();

const renderMonthHeader = () => {
    const monthHeader = document.getElementById("current-month");
    monthHeader.textContent = `${months[currentMonthIndex - 1]}, ${currentYear}`;
};

// Định nghĩa hàm formatCurrency
const formatCurrency = (amount) => {
    return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');  // Thêm dấu phẩy ở mỗi ba chữ số
};

const checkBudgetAndDisplayAlert = () => {
    const budgets = JSON.parse(localStorage.getItem('budgets')) || {}; // Lấy ngân sách từ localStorage
    const categoryExpenses = JSON.parse(localStorage.getItem('categoryExpenses')) || {}; // Lấy chi tiêu từ localStorage
    const currentMonthKey = `${currentMonthIndex}-${currentYear}`;
    const monthExpenses = categoryExpenses[currentMonthKey] || {}; // Chi tiêu của tháng hiện tại
    const budgetAlert = document.getElementById('budget-alert'); // Vị trí hiển thị cảnh báo

    let alertMessage = '';

    // Lặp qua các danh mục chi tiêu trong tháng hiện tại
    for (const [category, expenseAmount] of Object.entries(monthExpenses)) {
        const expenseValue = parseFloat(expenseAmount) || 0; // Tổng chi tiêu thực tế
        const budgetAmount = parseFloat((budgets[currentMonthKey]?.[category] || '0')) || 0; // Ngân sách đã đặt

        if (budgetAmount > 0 && expenseValue > budgetAmount) {
            // Nếu vượt ngân sách, tạo thông báo
            const categoryName = category.includes('|') ? category.split('|')[1] : category; // Lấy tên danh mục
            const icon = category.split('|')[0] || ''; // Lấy icon từ danh mục
            alertMessage += `
                <p>${icon} <strong>${categoryName}</strong> vượt ngân sách!
                Chi tiêu: <strong>${formatCurrency(expenseValue)}</strong> VND,
                Ngân sách: <strong>${formatCurrency(budgetAmount)}</strong> VND.</p>`;
        }
    }

    // Hiển thị thông báo nếu có
    if (alertMessage) {
        budgetAlert.innerHTML = `<div class="alert alert-danger">${alertMessage}</div>`;
    } else {
        budgetAlert.innerHTML = ''; // Xóa thông báo nếu không vượt ngân sách
    }
};

const calculateTotalExpenses = () => {
    const transactions = JSON.parse(localStorage.getItem('transactions')) || [];
    const categoryExpenses = JSON.parse(localStorage.getItem('categoryExpenses')) || {}; // Lấy dữ liệu đã lưu trước đó

    // Dùng để kiểm tra tổng số tiền hiện tại trước khi cộng
    const newCategoryExpenses = {};

    // Tính tổng chi tiêu cho từng tháng từ danh sách giao dịch
    transactions.forEach(tx => {
        const transactionDate = new Date(tx.date);
        const transactionMonth = transactionDate.getMonth() + 1; // Lấy tháng từ 1-12
        const transactionYear = transactionDate.getFullYear();
        const monthKey = `${transactionMonth}-${transactionYear}`; // Tạo khóa cho từng tháng

        // Bỏ qua nếu đây là khoản thu
        if (tx.type && tx.type.toLowerCase() === 'income') {
            return; // Bỏ qua khoản thu
        }

        // Khởi tạo đối tượng cho tháng nếu chưa tồn tại
        if (!newCategoryExpenses[monthKey]) {
            newCategoryExpenses[monthKey] = {};
        }

        const category = tx.category;
        const rawAmount = tx.amount.replace(/,/g, '').trim(); // Loại bỏ dấu phẩy và khoảng trắng
        const amount = parseFloat(rawAmount) || 0; // Chuyển thành số nguyên thủy
        const icon = tx.icon || "💰"; // Lấy icon từ giao dịch hoặc mặc định là 💰

        // Cộng dồn chi tiêu theo danh mục
        if (!newCategoryExpenses[monthKey][`${icon} ${category}`]) {
            newCategoryExpenses[monthKey][`${icon} ${category}`] = 0; // Bắt đầu từ 0
        }

        newCategoryExpenses[monthKey][`${icon} ${category}`] += amount; // Cộng dồn
    });

    // Kiểm tra nếu dữ liệu không thay đổi, không cần ghi đè
    let hasChanges = false;
    for (const monthKey in newCategoryExpenses) {
        if (!categoryExpenses[monthKey]) {
            categoryExpenses[monthKey] = {};
            hasChanges = true;
        }

        for (const categoryKey in newCategoryExpenses[monthKey]) {
            const newTotal = newCategoryExpenses[monthKey][categoryKey];
            const currentTotal = parseFloat(
                (categoryExpenses[monthKey][categoryKey] || '0').toString().replace(/,/g, '')
            ) || 0;

            if (newTotal !== currentTotal) {
                categoryExpenses[monthKey][categoryKey] = newTotal.toLocaleString('en-US'); // Định dạng số tiền
                hasChanges = true; // Đánh dấu có thay đổi
            }
        }
    }

    // Chỉ lưu vào LocalStorage nếu có thay đổi
    if (hasChanges) {
        localStorage.setItem('categoryExpenses', JSON.stringify(categoryExpenses));
    }
};




const renderTransactions = () => {
    const list = document.getElementById("transactions-list");
    const transactions = JSON.parse(localStorage.getItem('transactions')) || [];
    list.innerHTML = "";

    const filteredTransactions = transactions.filter(transaction => {
        const transactionDate = new Date(transaction.date);
        return (
            transactionDate.getMonth() + 1 === currentMonthIndex &&
            transactionDate.getFullYear() === currentYear
        );
    });

    if (filteredTransactions.length === 0) {
        list.innerHTML = '<p class="no-transactions">Không có giao dịch nào trong tháng này.</p>';
        return;
    }

    let currentDay = "";

    filteredTransactions.forEach((transaction, index) => {
        const transactionDate = new Date(transaction.date);
        const formattedDate = `${transactionDate.getDate()}, ${months[transactionDate.getMonth()]} ${transactionDate.getFullYear()}`;

        if (formattedDate !== currentDay) {
            currentDay = formattedDate;
            const dayHeader = document.createElement("div");
            dayHeader.className = "transaction-day";
            dayHeader.textContent = formattedDate;
            list.appendChild(dayHeader);
        }

        const entry = document.createElement("div");
        entry.className = "transaction-entry";

        entry.innerHTML = `
            <div class="icon">${transaction.icon || "💰"}</div>
            <div class="details">
                <p class="description">${transaction.description}</p>
                <p class="category">${transaction.category}</p>
            </div>
            <div class="amount">${transaction.amount}₫</div>
        `;

        // Thêm sự kiện xóa
        entry.addEventListener("dblclick", () => handleDeleteTransaction(index));
        list.appendChild(entry);
    });

    calculateTotalExpenses();
};

const handleDeleteTransaction = (index) => {
    const transactions = JSON.parse(localStorage.getItem("transactions")) || [];
    const transaction = transactions[index];

    if (confirm(`Bạn có chắc chắn muốn xóa giao dịch: "${transaction.description}"?`)) {
        transactions.splice(index, 1);
        localStorage.setItem("transactions", JSON.stringify(transactions));
        calculateTotalExpenses();
        alert("Giao dịch đã được xóa thành công!");
    }
};

const switchMonth = (direction) => {
    currentMonthIndex += direction;
    if (currentMonthIndex < 1) {
        currentMonthIndex = 12;
        currentYear -= 1;
    } else if (currentMonthIndex > 12) {
        currentMonthIndex = 1;
        currentYear += 1;
    }

    renderMonthHeader();
    renderTransactions();
    calculateTotalExpenses();
    checkBudgetAndDisplayAlert();
};

document.getElementById("prev-month").addEventListener("click", () => switchMonth(-1));
document.getElementById("next-month").addEventListener("click", () => switchMonth(1));

// Initial render
document.addEventListener('DOMContentLoaded', () => {
    renderMonthHeader();
    renderTransactions();
    calculateTotalExpenses();
    checkBudgetAndDisplayAlert();
});


 
    </script>
</body>

</html>