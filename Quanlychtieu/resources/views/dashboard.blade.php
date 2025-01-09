<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Personal Finance Dashboard</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

        <style>
            /* General Styles */
            body {
                font-family: 'Roboto', Arial, sans-serif;
                margin: 0;
                height: 100vh;
                background: linear-gradient(135deg, #f7f9fc, #e9eff9);
                /* Màu nền tổng thể */
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
        <nav>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="dashboard.blade.php" class="nav-link active">Dashboard</a></li>
                <li class="nav-item"><a href="expense.blade.php" class="nav-link">Chi tiêu</a></li>
                <li class="nav-item"><a href="transaction.blade.php" class="nav-link">Sổ giao dịch</a></li>
                <li class="nav-item"><a href="remind.blade.php" class="nav-link">Nhắc nhở</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Phân tích</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Cài đặt</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <div class="container">
                <!-- Month Navigation -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span id="prev-month">&lt;</span>
                    <select id="month-selector" class="form-select">
                        <!-- Tháng sẽ được thêm động trong JavaScript -->
                    </select>
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
        </script>

    </body>

    </html>
