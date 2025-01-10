<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Finance Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
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
            <li class="nav-item"><a href="expense.blade.php" class="nav-link">Thu chi</a></li>
            <li class="nav-item"><a href="transaction.blade.php" class="nav-link active">Sổ giao dịch</a></li>
            <li class="nav-item"><a href="remind.blade.php" class="nav-link">Nhắc nhở</a></li>
            <li class="nav-item"><a href="bugdget.blade.php" class="nav-link ">Ngân sách</a></li>
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

const handleDeleteTransaction = (filteredIndex) => {
    const transactions = JSON.parse(localStorage.getItem("transactions")) || [];
    const categoryExpenses = JSON.parse(localStorage.getItem("categoryExpenses")) || {};
    const filteredTransactions = transactions.filter(tx => {
        const txDate = new Date(tx.date);
        return (
            txDate.getMonth() + 1 === currentMonthIndex &&
            txDate.getFullYear() === currentYear
        );
    });

    const transaction = filteredTransactions[filteredIndex]; // Giao dịch hiển thị trên giao diện

    if (confirm(`Bạn có chắc chắn muốn xóa giao dịch: "${transaction.description}"?`)) {
        // Xác định vị trí chính xác của giao dịch trong danh sách gốc
        const transactionIndex = transactions.findIndex(tx =>
            tx.date === transaction.date &&
            tx.type === transaction.type &&
            tx.category === transaction.category &&
            tx.amount === transaction.amount
        );

        if (transactionIndex !== -1) {
            // Xóa giao dịch khỏi danh sách gốc
            transactions.splice(transactionIndex, 1);
            localStorage.setItem("transactions", JSON.stringify(transactions));

            // Xóa tổng chi tiêu khỏi categoryExpenses
            const transactionDate = new Date(transaction.date);
            const transactionMonth = transactionDate.getMonth() + 1; // Tháng từ 1-12
            const transactionYear = transactionDate.getFullYear();
            const monthKey = `${transactionMonth}-${transactionYear}`;
            const categoryKey = `${transaction.icon || "💰"} ${transaction.category}`;

            if (categoryExpenses[monthKey] && categoryExpenses[monthKey][categoryKey]) {
                const currentAmount = parseFloat(
                    categoryExpenses[monthKey][categoryKey].toString().replace(/,/g, '')
                ) || 0;
                const transactionAmount = parseFloat(transaction.amount.replace(/,/g, '')) || 0;

                const updatedAmount = currentAmount - transactionAmount;

                if (updatedAmount > 0) {
                    categoryExpenses[monthKey][categoryKey] = updatedAmount.toLocaleString('en-US');
                } else {
                    delete categoryExpenses[monthKey][categoryKey];

                    if (Object.keys(categoryExpenses[monthKey]).length === 0) {
                        delete categoryExpenses[monthKey];
                    }
                }

                localStorage.setItem("categoryExpenses", JSON.stringify(categoryExpenses));
            }

            // Cập nhật lại giao diện
            renderTransactions();
            calculateTotalExpenses();
          

            alert("Giao dịch đã được xóa thành công!");
        } else {
            alert("Không tìm thấy giao dịch trong danh sách gốc!");
        }
    }
};


const renderTransactions = () => {
    const list = document.getElementById("transactions-list");
    const transactions = JSON.parse(localStorage.getItem("transactions")) || [];
    list.innerHTML = "";

    // Lọc giao dịch theo tháng hiện tại
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

    filteredTransactions.sort((a, b) => new Date(a.date) - new Date(b.date)); // Sắp xếp theo ngày

    filteredTransactions.forEach((transaction, index) => {
        const transactionDate = new Date(transaction.date);
        const formattedDate = `${transactionDate.getDate()}, ${months[transactionDate.getMonth()]} ${transactionDate.getFullYear()}`;

        // Hiển thị ngày nếu khác ngày trước đó
        if (formattedDate !== currentDay) {
            currentDay = formattedDate;
            const dayHeader = document.createElement("div");
            dayHeader.className = "transaction-day";
            dayHeader.textContent = formattedDate;
            list.appendChild(dayHeader);
        }

        // Tạo giao diện hiển thị giao dịch
        const entry = document.createElement("div");
        entry.className = "transaction-entry";

        const description = transaction.description || "Không có mô tả";
        const category = transaction.category || "Không có danh mục";

        entry.innerHTML = `
            <div class="icon">${transaction.icon || "💰"}</div>
            <div class="details">
                <p class="description">${description}</p>
                <p class="category">${category}</p>
            </div>
            <div class="amount ${transaction.type === "expense" ? "text-danger" : "text-success"}">
                ${formatCurrency(transaction.amount)}₫
            </div>
        `;

        // Truyền `index` vào sự kiện `dblclick`
        entry.addEventListener("dblclick", () => handleDeleteTransaction(index));
        list.appendChild(entry);
    });

    calculateTotalExpenses();
};




document.getElementById("export-sql").addEventListener("click", () => {
    const transactions = JSON.parse(localStorage.getItem("transactions")) || [];
    const categoryExpenses = JSON.parse(localStorage.getItem("categoryExpenses")) || {};

    if (transactions.length === 0) {
        alert("Không có giao dịch nào để xuất!");
        return;
    }

    // Tạo câu lệnh SQL cho bảng transactions
    let sqlContent = `
        CREATE TABLE IF NOT EXISTS transactions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            date DATE NOT NULL,
            category VARCHAR(255) NOT NULL,
            amount DECIMAL(15, 2) NOT NULL,
            type ENUM('income', 'expense') NOT NULL,
            icon VARCHAR(10) DEFAULT NULL
        );

        INSERT INTO transactions (date, category, amount, type, icon) VALUES
    `;

    transactions.forEach((transaction, index) => {
        const date = transaction.date;
        const category = transaction.category.replace(/'/g, "''"); // Escape ký tự đặc biệt
        const amount = transaction.amount.replace(/,/g, ""); // Loại bỏ dấu phẩy
        const type = transaction.type;
        const icon = transaction.icon || "💰";

        sqlContent += `('${date}', '${category}', ${amount}, '${type}', '${icon}')${
            index < transactions.length - 1 ? "," : ";"
        }\n`;
    });

    // Tạo câu lệnh SQL cho tổng chi tiêu theo danh mục
    sqlContent += `
        CREATE TABLE IF NOT EXISTS category_totals (
            id INT AUTO_INCREMENT PRIMARY KEY,
            month_key VARCHAR(7) NOT NULL,
            category VARCHAR(255) NOT NULL,
            total_amount DECIMAL(15, 2) NOT NULL
        );

        INSERT INTO category_totals (month_key, category, total_amount) VALUES
    `;

    let totalEntries = [];
    Object.keys(categoryExpenses).forEach(monthKey => {
        const monthExpenses = categoryExpenses[monthKey];
        for (const [category, amount] of Object.entries(monthExpenses)) {
            const totalAmount = parseFloat(amount.replace(/,/g, "")); // Không thêm `.00`
            totalEntries.push(`('${monthKey}', '${category.replace(/'/g, "''")}', ${totalAmount})`);
        }
    });

    sqlContent += totalEntries.join(",\n") + ";";

    // Tải file SQL
    const blob = new Blob([sqlContent], { type: "text/sql" });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = "transactions_and_totals.sql";
    link.click();
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

    renderMonthHeader();
    renderTransactions();
    calculateTotalExpenses();
   
  
};

document.getElementById("prev-month").addEventListener("click", () => switchMonth(-1));
document.getElementById("next-month").addEventListener("click", () => switchMonth(1));

// Initial render
document.addEventListener('DOMContentLoaded', () => {
    renderMonthHeader();
    renderTransactions();
    calculateTotalExpenses();
    

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