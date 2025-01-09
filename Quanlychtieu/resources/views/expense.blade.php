<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Personal Finance Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f8f9fa, #e3e7ed);
            margin: 0;
            height: 100vh;
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

        .btn-primary {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            border: none;
            font-weight: bold;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #3b3ccf, #4e54c8);
        }


        .recent-categories span {
            background: rgba(0, 0, 0, 0.05);
            padding: 3px 10px;
            border-radius: 15px;
            margin-right: 5px;
            cursor: pointer;
        }

        .recent-categories span:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        #prev-month,
        #next-month {
            font-size: 24px;
            color: #4e54c8;
            cursor: pointer;
        }

        #prev-month:hover,
        #next-month:hover {
            color: #3b3ccf;
        }

        .tab-content {
            margin-top: 20px;
        }

        .form-control {
            border-radius: 8px;
        }

        .form-select {
            border-radius: 8px;
        }

        #create-new {
            background: rgba(255, 255, 255, 255);
            color: black;
            border: none;
            width: 120px;
            border-radius: 6px;
            padding: 6px 8px;
            display: flex;
            align-items: center;
            cursor: pointer;
            font-weight: bold;
            /* Làm chữ in đậm */
            transition: all 0.3s ease;
            /* Hiệu ứng mượt khi hover */
            justify-content: center;
        }

        .create-new-income {
            background: rgba(255, 255, 255, 255);
            color: black;
            border: none;
            width: 120px;
            border-radius: 6px;
            padding: 6px 8px;
            display: flex;
            align-items: center;
            cursor: pointer;
            font-weight: bold;
            /* Làm chữ in đậm */
            transition: all 0.3s ease;
            /* Hiệu ứng mượt khi hover */
            justify-content: center;
        }

        #create-new:hover {
            background: rgba(200, 200, 200, 0.8);
            /* Nền xám nhạt khi hover */
        }


        .icon-picker {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            /* Khoảng cách giữa các biểu tượng */
            padding: 10px;
            max-height: 200px;
            /* Giới hạn chiều cao */
            overflow-y: auto;
            /* Thêm thanh cuộn dọc */
            justify-content: center;
        }

        /* Biểu tượng */
        .icon-picker div {
            text-align: center;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            transition: transform 0.2s;
        }

        .icon-picker div:hover {
            background: #f0f0f0;
            /* Nền xám nhạt khi hover */
            transform: scale(1.1);
            /* Phóng to nhẹ khi hover */
        }
    </style>
</head>

<body>
    <!-- Sidebar Navigation -->
    <nav>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="dashboard.blade.php" class="nav-link ">Dashboard</a></li>
            <li class="nav-item"><a href="expense.blade.php" class="nav-link active ">Chi tiêu</a></li>
            <li class="nav-item"><a href="transaction.blade.php" class="nav-link">Sổ giao dịch</a></li>
            <li class="nav-item"><a href="remind.blade.php" class="nav-link">Nhắc nhở</a></li>
            <li class="nav-item"><a href="bugdget.blade.php" class="nav-link">Ngân sách</a></li>
            <li class="nav-item"><a href="setting.blade.php" class="nav-link">Cài đặt</a></li>
        </ul>
    </nav>
    <div class="main-content">
        <div class="container">
            <h2 class="mb-4">Quản lý chi tiêu cá nhân</h2>
            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="transaction-tabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="expense-tab" data-bs-toggle="tab" data-bs-target="#expense" type="button" role="tab" aria-controls="expense" aria-selected="true">Chi tiêu</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="income-tab" data-bs-toggle="tab" data-bs-target="#income" type="button" role="tab" aria-controls="income" aria-selected="false">Thu nhập</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="transaction-tabContent">
                <!-- Expense Tab -->
                <div class="tab-pane fade show active" id="expense" role="tabpanel" aria-labelledby="expense-tab">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Thêm Chi Tiêu</h5>
                            <form id="expense-form">
                                <div class="mb-3">
                                    <label for="expense-amount" class="form-label">Số tiền</label>
                                    <input type="text" class="form-control" id="expense-amount" placeholder="" required>
                                </div>
                                <div class="mb-3">
                                    <label for="expense-category" class="form-label">Danh mục</label>
                                    <select class="form-select" id="expense-category" required>
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

                                    <!-- Recent categories -->
                                    <div class="recent-categories" id="recent-expense-categories">
                                        <strong>Danh mục gần đây: </strong>

                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="expense-date" class="form-label">Ngày giao dịch</label>
                                    <input type="date" class="form-control" id="expense-date" required>
                                </div>
                                <div class="mb-3">
                                    <label for="expense-description" class="form-label">Mô tả</label>
                                    <textarea class="form-control" id="expense-description" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Thêm Giao Dịch</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="income" role="tabpanel" aria-labelledby="income-tab">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Thêm Thu Nhập</h5>
                            <form id="income-form">
                                <div class="mb-3">
                                    <label for="income-amount" class="form-label">Số tiền</label>
                                    <input type="text" class="form-control" id="income-amount" placeholder="" required>
                                </div>
                                <div class="mb-3">
                                    <label for="income-category" class="form-label">Danh mục</label>
                                    <select class="form-select" id="income-category" required>
                                        <option value="" selected disabled>Chọn danh mục</option>
                                        <option value="💼|Lương">💼 Lương</option>
                                        <option value="🎁|Thưởng">🎁 Thưởng</option>
                                        <option value="💵|Thu hồi nợ">💵 Thu hồi nợ</option>
                                        <option value="🏢|Kinh doanh">🏢 Kinh doanh</option>
                                        <option value="📊|Lợi nhuận">📊 Lợi nhuận</option>
                                        <option value="🤝|Trợ cấp">🤝 Trợ cấp</option>
                                        <option value="🔧|Khác">🔧 Khác</option>
                                    </select>
                                    <div class="recent-categories" id="recent-income-categories">
                                        <strong>Danh mục gần đây: </strong>

                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="income-date" class="form-label">Ngày giao dịch</label>
                                    <input type="date" class="form-control" id="income-date" required>
                                </div>
                                <div class="mb-3">
                                    <label for="income-description" class="form-label">Mô tả</label>
                                    <textarea class="form-control" id="income-description" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Thêm Giao Dịch</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="category-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0, 0, 0, 0.5); z-index: 9999; display: flex; justify-content: center; align-items: center;">
                    <div style="background: #f5f5f5; padding: 20px; border-radius: 10px; width: 90%; max-width: 500px;height:500px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <h5 style="margin: 0;">Chọn danh mục</h5>
                            <button id="close-modal" style="background: none; border: none; font-size: 20px; cursor: pointer;">×</button>
                        </div>
                        <div style="display: flex; justify-content: flex-end; align-items: center; margin-top: 10px;">
                            <button class="create-new" id="create-new">
                                <span style="font-size: 18px; margin-right: 5px;">+</span>
                                <span>Tạo mới</span>
                            </button>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <h6 style="color: #f76c6c;">Chi tiêu - sinh hoạt</h6>
                            <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 10px;align-items: center;align-content: center">
                                <button style="background: #fce4ec; border: none; border-radius: 8px; padding: 10px; display: flex; flex-direction: column; align-items: center; cursor: pointer;">
                                    <span>🍔</span>
                                    <small>Ăn uống</small>
                                </button>
                                <button style="background: #e1f5fe; border: none; border-radius: 8px; padding: 10px; display: flex; flex-direction: column; align-items: center; cursor: pointer;">
                                    <span>🛒</span>
                                    <small>Chợ, siêu thị</small>
                                </button>
                                <button style="background: #e8f5e9; border: none; border-radius: 8px; padding: 10px; display: flex; flex-direction: column; align-items: center; cursor: pointer;">
                                    <span>🚗</span>
                                    <small>Di chuyển</small>
                                </button>
                            </div>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <h6 style="color: #fbc02d;">Chi phí phát sinh</h6>
                            <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 10px;align-items: center;align-content: center">
                                <button style="background: #fce4ec; border: none; border-radius: 8px; padding: 10px; display: flex; flex-direction: column; align-items: center; cursor: pointer;">
                                    <span>🛍️</span>
                                    <small>Mua sắm</small>
                                </button>
                                <button style="background: #e1f5fe; border: none; border-radius: 8px; padding: 10px; display: flex; flex-direction: column; align-items: center; cursor: pointer;">
                                    <span>🎮</span>
                                    <small>Giải trí</small>
                                </button>
                                <button style="background: #f8bbd0; border: none; border-radius: 8px; padding: 10px; display: flex; flex-direction: column; align-items: center; cursor: pointer;">
                                    <span>💅</span>
                                    <small>Làm đẹp</small>
                                </button>
                                </button>
                                <button style="background: #ffe0b2; border: none; border-radius: 8px; padding: 10px; display: flex; flex-direction: column; align-items: center; cursor: pointer; ">
                                    <span>❤️</span>
                                    <small>Sức khỏe</small>
                                </button>
                                <button style="background: #c5e1a5; border: none; border-radius: 8px; padding: 10px; display: flex; flex-direction: column; align-items: center; cursor: pointer; ">
                                    <span>🎁</span>
                                    <small>Từ thiện</small>
                                </button>
                            </div>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <h6 style="color: #42a5f5;">Chi phí cố định</h6>
                            <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 10px;align-items: center;align-content: center;">
                                <button style="background: #ffccbc; border: none; border-radius: 8px; padding: 10px; display: flex; flex-direction: column; align-items: center; cursor: pointer; ">
                                    <span>🧾</span>
                                    <small>Hóa đơn</small>
                                </button>
                                <button style="background: #bbdefb; border: none; border-radius: 8px; padding: 10px; display: flex; flex-direction: column; align-items: center; cursor: pointer;">
                                    <span>🏠</span>
                                    <small>Nhà cửa</small>
                                </button>
                                <button style="background: #d1c4e9; border: none; border-radius: 8px; padding: 10px; display: flex; flex-direction: column; align-items: center; cursor: pointer;">
                                    <span>👨‍👩‍👧‍👦</span>
                                    <small>Người thân</small>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="income-category-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0, 0, 0, 0.5); z-index: 9999; display: flex; justify-content: center; align-items: center;">
                    <div style="background: #f5f5f5; padding: 20px; border-radius: 10px; width: 90%; max-width: 500px;height:500px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <h5 style="margin: 0;">Chọn danh mục thu nhập</h5>
                            <button id="close-income-modal" style="background: none; border: none; font-size: 20px; cursor: pointer;">×</button>
                        </div>
                        <div style="display: flex; justify-content: flex-end; align-items: center; margin-top: 10px;">
                            <button class="create-new-income" id="create-new-income">
                                <span style="font-size: 18px; margin-right: 5px;">+</span>
                                <span>Tạo mới</span>
                            </button>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <h6 style="color: #fbc02d;">Thu nhập - lương</h6>
                            <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 10px; align-items: center; align-content: center">
                                <button style="background: #ffe0b2; border: none; border-radius: 8px; padding: 10px; display: flex; flex-direction: column; align-items: center; cursor: pointer;">
                                    <span>💼</span>
                                    <small>Lương</small>
                                </button>
                                <button style="background: #e1f5fe; border: none; border-radius: 8px; padding: 10px; display: flex; flex-direction: column; align-items: center; cursor: pointer;">
                                    <span>🎁</span>
                                    <small>Thưởng</small>
                                </button>
                                <button style="background: #c5e1a5; border: none; border-radius: 8px; padding: 10px; display: flex; flex-direction: column; align-items: center; cursor: pointer;">
                                    <span>💵</span>
                                    <small>Thu hồi nợ</small>
                                </button>
                            </div>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <h6 style="color: #42a5f5;">Thu nhập - khác</h6>
                            <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 10px; align-items: center; align-content: center">
                                <button style="background: #bbdefb; border: none; border-radius: 8px; padding: 10px; display: flex; flex-direction: column; align-items: center; cursor: pointer;">
                                    <span>🏢</span>
                                    <small>Kinh doanh</small>
                                </button>
                                <button style="background: #fce4ec; border: none; border-radius: 8px; padding: 10px; display: flex; flex-direction: column; align-items: center; cursor: pointer;">
                                    <span>📊</span>
                                    <small>Lợi nhuận</small>
                                </button>
                                <button style="background: #d1c4e9; border: none; border-radius: 8px; padding: 10px; display: flex; flex-direction: column; align-items: center; cursor: pointer;">
                                    <span>🤝</span>
                                    <small>Trợ cấp</small>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="create-category-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0, 0, 0, 0.5); z-index: 9999; justify-content: center; align-items: center;">
                    <div style="background: white; padding: 20px; border-radius: 12px; width: 90%; max-width: 400px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); position: relative;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <h5 style="margin: 0;">Tạo danh mục</h5>
                            <button id="close-create-modal" style="background: none; border: none; font-size: 20px; cursor: pointer;">×</button>
                        </div>
                        <div>
                            <div style="position: relative;text-align: center; margin-bottom: 20px;">
                                <div style="text-align: center; margin-bottom: 10px;">
                                    <span class="category-icon-placeholder" style="font-size: 48px; color: #f76c6c;">🏠</span>
                                    <div id="open-icon-picker" style="color: #f76c6c; cursor: pointer;">Chọn biểu tượng</div>
                                </div>
                                <div id="icon-picker-modal" style="position: absolute; top: 60px; left: 50%; transform: translateX(-50%); width: 300px; background: white; border: 1px solid rgb(204, 204, 204); border-radius: 12px; box-shadow: rgba(0, 0, 0, 0.3) 0px 5px 15px; z-index: 9999;">
                                    <div id="icon-picker" class="icon-picker">
                                    </div>
                                </div>
                                <div style="margin-bottom: 20px;text-align: left;">
                                    <label for="category-name" style="display: inline-block; margin-bottom: 5px; font-weight: bold;">Tên danh mục <span style="color: red;">*</span></label>
                                    <input type="text" id="category-name" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Nhập tên">
                                </div>
                                <div style="margin-bottom: 20px;text-align: left;">
                                    <label for="parent-category" style="display: inline-block; margin-bottom: 5px; font-weight: bold;">Thuộc danh mục <span style="color: red;">*</span></label>
                                    <select id="parent-category" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                                        <option value="" selected disabled>Chọn</option>
                                        <option value="expense">Chi tiêu</option>
                                        <option value="income">Thu nhập</option>
                                    </select>
                                </div>
                                <button id="submit-category" style="width: 100%; padding: 10px; background: #f76c6c; color: white; border: none; border-radius: 5px; cursor: pointer;">Xác nhận</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="create-category-modal-income" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0, 0, 0, 0.5); z-index: 9999; justify-content: center; align-items: center;">
                    <div style="background: white; padding: 20px; border-radius: 12px; width: 90%; max-width: 400px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); position: relative;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <h5 style="margin: 0;">Tạo danh mục thu nhập</h5>
                            <button id="close-create-modal-income" style="background: none; border: none; font-size: 20px; cursor: pointer;">×</button>
                        </div>
                        <div>
                            <div style="position: relative;text-align: center; margin-bottom: 20px;">
                                <div style="text-align: center; margin-bottom: 10px;">
                                    <span class="category-icon-placeholder-income" style="font-size: 48px; color: #f76c6c;">💰</span>
                                    <div id="open-icon-picker-income" style="color: #f76c6c; cursor: pointer;">Chọn biểu tượng</div>
                                </div>
                                <div id="icon-picker-modal-income" style="position: absolute; top: 60px; left: 50%; transform: translateX(-50%); width: 300px; background: white; border: 1px solid rgb(204, 204, 204); border-radius: 12px; box-shadow: rgba(0, 0, 0, 0.3) 0px 5px 15px; z-index: 9999;">
                                    <div id="icon-picker-income" class="icon-picker">                                    </div>
                                </div>
                                <div style="margin-bottom: 20px;text-align: left;">
                                    <label for="category-name-income" style="display: inline-block; margin-bottom: 5px; font-weight: bold;">Tên danh mục <span style="color: red;">*</span></label>
                                    <input type="text" id="category-name-income" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Nhập tên">
                                </div>
                                <div style="margin-bottom: 20px;text-align: left;">
                                    <label for="parent-category-income" style="display: inline-block; margin-bottom: 5px; font-weight: bold;">Thuộc danh mục <span style="color: red;">*</span></label>
                                    <select id="parent-category-income" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                                        <option value="" selected disabled>Chọn</option>
                                        <option value="expense">Chi tiêu</option>
                                        <option value="income">Thu nhập</option>
                                    </select>
                                </div>
                                <button id="submit-category-income" style="width: 100%; padding: 10px; background: #f76c6c; color: white; border: none; border-radius: 5px; cursor: pointer;">Xác nhận</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const recentExpenseCategoriesElem = document.getElementById('recent-expense-categories');
                    const recentIncomeCategoriesElem = document.getElementById('recent-income-categories');
                    const MAX_RECENT_CATEGORIES = 5; 
                    const loadRecentCategories = (key) => {
                        return JSON.parse(localStorage.getItem(key)) || [];
                    };
                    const saveRecentCategory = (key, icon, category) => {
                        const recentCategories = loadRecentCategories(key);
                        const newCategory = `${icon} ${category}`;
                        const updatedCategories = recentCategories.filter(c => c !== newCategory);
                        updatedCategories.unshift(newCategory);
                        if (updatedCategories.length > MAX_RECENT_CATEGORIES) {
                            updatedCategories.pop();
                        }
                        localStorage.setItem(key, JSON.stringify(updatedCategories));
                    };
                    const renderRecentCategories = (key, element, categoryFieldId) => {
                        const recentCategories = loadRecentCategories(key);

                        if (recentCategories.length === 0) {
                            element.innerHTML = `<strong>Danh mục gần đây:</strong> <em>Không có danh mục gần đây</em>`;
                            return;
                        }
                        element.innerHTML = `<strong>Danh mục gần đây:</strong> ${recentCategories
                .map(category => `<span style="cursor: pointer; margin-right: 5px;">${category}</span>`)
                .join('')}`;
                        element.querySelectorAll('span').forEach(span => {
                            span.addEventListener('click', () => {
                                const categoryText = span.textContent.trim();
                                const [icon, ...categoryParts] = categoryText.split(' ');
                                const category = categoryParts.join(' ');
                                document.getElementById(categoryFieldId).value = `${icon}|${category}`;
                            });
                        });
                    };
                    const formatCurrency = (input) => {
                        input.addEventListener('input', (e) => {
                            let value = e.target.value.replace(/[^\d]/g, ''); 
                            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                            e.target.value = value;
                        });
                    };
                    const handleSubmit = (formId, type, recentCategoriesKey, recentCategoriesElem, categoryFieldId) => {
                        document.getElementById(formId).addEventListener('submit', function(e) {
                            e.preventDefault();
                            const amountInput = document.getElementById(`${type}-amount`);
                            const amountFormatted = amountInput.value.trim();
                            const amount = amountFormatted.replace(/,/g, ''); // Remove commas for storing
                            const date = document.getElementById(`${type}-date`).value.trim();
                            const categoryField = document.getElementById(categoryFieldId);
                            const categoryValue = categoryField.value; // Lấy giá trị danh mục
        const description = document.getElementById(`${type}-description`).value.trim();

        if (!categoryField) {
            alert('Danh mục không tồn tại. Vui lòng kiểm tra lại.');
            return;
        }
        
                            if (!amount || !categoryValue || !date || !description) {
                                alert('Vui lòng điền đầy đủ thông tin.');
                                return;
                            }
                            const [icon, category] = categoryValue.split('|').map(item => item.trim());
                            saveRecentCategory(recentCategoriesKey, icon, category);

                            const transaction = {
                                type,
                                amount: amountFormatted, // Store with commas for consistency
                                category: category.trim(),
                                date,
                                description,
                                icon: icon.trim(),
                            };

                            const transactions = JSON.parse(localStorage.getItem('transactions')) || [];
                            transactions.push(transaction);
                            localStorage.setItem('transactions', JSON.stringify(transactions));

                            alert(`Giao dịch ${type === 'expense' ? 'chi tiêu' : 'thu nhập'} đã được thêm thành công!`);
                            e.target.reset(); 
                            renderRecentCategories(recentCategoriesKey, recentCategoriesElem, (selectedCategory) => {
                                document.getElementById(categoryFieldId).value = `${icon}|${category}`; // Set value in select
                            });
                        });
                    };

                    // Khi thêm chi tiêu
                    handleSubmit(
                        'expense-form',
                        'expense',
                        'recentExpenseCategories',
                        recentExpenseCategoriesElem,
                        'expense-category'
                    );

                    // Khi thêm thu nhập
                    handleSubmit(
                        'income-form',
                        'income',
                        'recentIncomeCategories',
                        recentIncomeCategoriesElem,
                        'income-category'
                    );

                    // Lần đầu render danh mục gần đây
                    renderRecentCategories('recentExpenseCategories', recentExpenseCategoriesElem, 'expense-category');
                    renderRecentCategories('recentIncomeCategories', recentIncomeCategoriesElem, 'income-category');


                    // Định dạng số tiền cho các trường nhập liệu
                    formatCurrency(document.getElementById('expense-amount'));
                    formatCurrency(document.getElementById('income-amount'));
                });
                document.addEventListener('DOMContentLoaded', () => {
                    const modal = document.getElementById('category-modal'); // Modal
                    const closeModal = document.getElementById('close-modal'); // Nút đóng modal
                    const triggerElement = document.getElementById('expense-category'); // Phần tử kích hoạt modal
                    const createNewButton = document.getElementById('create-new'); // Nút Tạo mới
                    let clickTimer = null; // Timer để phân biệt giữa click và double-click

                    // Đảm bảo modal luôn bị ẩn khi tải trang
                    modal.style.display = 'none';

                    // Lắng nghe sự kiện click 1 lần và double-click
                    triggerElement.addEventListener('click', () => {
                        if (clickTimer !== null) {
                            // Nếu click thứ hai xảy ra trong thời gian ngắn => double-click
                            clearTimeout(clickTimer); // Xóa timer
                            clickTimer = null;

                            // Hiển thị modal khi double-click
                            modal.style.display = 'flex';
                        } else {
                            // Nếu chỉ click 1 lần
                            clickTimer = setTimeout(() => {
                                clickTimer = null; // Reset timer
                                console.log('Chọn danh mục bình thường'); // Hoạt động chọn bình thường
                            }, 300); // Thời gian chờ để xác định double-click (300ms)
                        }
                    });

                    // Hiển thị modal khi nhấn nút "Tạo mới"
                    createNewButton.addEventListener('click', () => {
                        modal.style.display = 'flex';
                    });

                    // Đóng modal khi nhấn nút "×"
                    closeModal.addEventListener('click', () => {
                        modal.style.display = 'none';
                    });

                    // Đóng modal khi nhấn ra ngoài modal
                    modal.addEventListener('click', (event) => {
                        if (event.target === modal) {
                            modal.style.display = 'none';
                        }
                    });
                });
                document.addEventListener('DOMContentLoaded', () => {
                    const createNewButton = document.getElementById('create-new'); // Nút Tạo mới
                    const createCategoryModal = document.getElementById('create-category-modal'); // Modal Tạo danh mục
                    const closeCreateModal = document.getElementById('close-create-modal'); // Nút đóng modal

                    // Hiển thị modal khi nhấn nút Tạo mới
                    createNewButton.addEventListener('click', () => {
                        createCategoryModal.style.display = 'flex';
                    });

                    // Đóng modal khi nhấn nút đóng
                    closeCreateModal.addEventListener('click', () => {
                        createCategoryModal.style.display = 'none';
                    });

                    // Đóng modal khi nhấn ra ngoài modal
                    createCategoryModal.addEventListener('click', (event) => {
                        if (event.target === createCategoryModal) {
                            createCategoryModal.style.display = 'none';
                        }
                    });


                    expense.addEventListener('click', () => {
                        expense.style.borderBottom = '2px solid #f76c6c';
                        expense.style.color = '#f76c6c';
                        expense.style.fontWeight = 'bold';

                        income.style.borderBottom = '2px solid transparent';
                        income.style.color = '#999';
                        income.style.fontWeight = 'normal';
                    });

                    income.addEventListener('click', () => {
                        income.style.borderBottom = '2px solid #f76c6c';
                        income.style.color = '#f76c6c';
                        income.style.fontWeight = 'bold';

                        expense.style.borderBottom = '2px solid transparent';
                        expense.style.color = '#999';
                        expense.style.fontWeight = 'normal';
                    });
                });
                document.addEventListener('DOMContentLoaded', () => {
                    const iconPickerModal = document.getElementById('icon-picker-modal');
                    const openIconPicker = document.getElementById('open-icon-picker');
                    const iconPicker = document.getElementById('icon-picker');
                    const iconPlaceholder = document.querySelector('.category-icon-placeholder');
                    const submitCategoryButton = document.getElementById('submit-category');
                    const categoryNameInput = document.getElementById('category-name');
                    const parentCategorySelect = document.getElementById('parent-category');
                    const expenseCategoryDropdown = document.getElementById('expense-category'); // Dropdown danh mục chi tiêu
                    const categoryModal = document.getElementById('create-category-modal');

                    const LOCAL_STORAGE_KEY = 'customCategories';

                    // Danh sách biểu tượng Unicode
                    const icons = [
                        '💡', '💧', '📱', '📺', '🌐', '🚕', '🍱', '🍿', '🏋️', '🛌',
                        '👗', '🎨', '🛠️', '🔧', '🐾', '🧹', '🧼', '📦', '🛡️', '💊',
                        '🌼', '🍹', '🏦', '🔒', '🏖️', '🛏️', '🎶', '🚴', '🖥️', '📚',
                        '🎤', '👶', '🎄', '🛍️'
                    ];

                    // Render danh sách biểu tượng
                    icons.forEach(icon => {
                        const iconElement = document.createElement('div');
                        iconElement.textContent = icon; // Hiển thị biểu tượng
                        iconElement.setAttribute('data-icon', icon); // Gán thuộc tính `data-icon`
                        iconPicker.appendChild(iconElement);

                        // Xử lý khi người dùng chọn biểu tượng
                        iconElement.addEventListener('click', () => {
                            iconPlaceholder.textContent = icon; // Hiển thị biểu tượng đã chọn
                            iconPlaceholder.setAttribute('data-icon', icon); // Gán thuộc tính `data-icon`
                            iconPickerModal.style.display = 'none'; // Đóng modal
                        });
                    });

                    // Hiển thị modal chọn biểu tượng
                    openIconPicker.addEventListener('click', () => {
                        iconPickerModal.style.display = 'flex';
                    });

                    // Đóng modal khi click bên ngoài
                    document.addEventListener('click', (event) => {
                        if (!iconPickerModal.contains(event.target) && event.target !== openIconPicker) {
                            iconPickerModal.style.display = 'none';
                        }
                    });

                    // Đóng modal bằng nút đóng
                    document.getElementById('close-modal').addEventListener('click', () => {
                        iconPickerModal.style.display = 'none';
                    });

                    // Xử lý khi nhấn nút "Xác nhận"
                    submitCategoryButton.addEventListener('click', () => {
                        const categoryName = categoryNameInput.value.trim();
                        const parentCategory = parentCategorySelect.value;
                        const icon = iconPlaceholder.getAttribute('data-icon'); // Lấy biểu tượng đã chọn

                        console.log('Category Name:', categoryName);
                        console.log('Parent Category:', parentCategory);
                        console.log('Icon:', icon);

                        if (!categoryName || !parentCategory || !icon) {
                            alert('Vui lòng điền đầy đủ thông tin.');
                            return;
                        }

                        // Kiểm tra danh mục có tồn tại trong localStorage chưa
                        const savedCategories = JSON.parse(localStorage.getItem(LOCAL_STORAGE_KEY)) || [];

                        // Kiểm tra xem danh mục đã tồn tại hay chưa (kiểm tra tên và loại danh mục)
                        const categoryExists = savedCategories.some(category => {
                            return category.name.toLowerCase() === categoryName.toLowerCase() && category.type === parentCategory;
                        });

                        if (categoryExists) {
                            alert('Danh mục này đã tồn tại. Vui lòng chọn tên khác.');
                            return;
                        }

                        // Tiến hành lưu danh mục vào localStorage nếu chưa tồn tại
                        savedCategories.push({
                            icon,
                            name: categoryName,
                            type: parentCategory
                        });

                        localStorage.setItem(LOCAL_STORAGE_KEY, JSON.stringify(savedCategories));

                        // Thêm danh mục mới vào danh sách
                        const newOption = document.createElement('option');
                        newOption.value = `${icon}|${categoryName}`;
                        newOption.textContent = `${icon} ${categoryName}`;

                        // Thêm vào dropdown nếu danh mục là "expense"
                        if (parentCategory === 'expense') {
                            expenseCategoryDropdown.appendChild(newOption);
                        }

                        // Reset modal và form
                        categoryNameInput.value = '';
                        parentCategorySelect.value = '';
                        iconPlaceholder.textContent = ''; // Xóa biểu tượng đã chọn
                        iconPlaceholder.removeAttribute('data-icon');
                        categoryModal.style.display = 'none';

                        alert('Danh mục mới đã được thêm thành công!');
                        const createCategoryModal = document.getElementById('create-category-modal');
                        createCategoryModal.style.display = 'none';
                    });

                    // Hàm tải các danh mục từ localStorage vào dropdown khi tải trang
                    const loadCategoriesFromLocalStorage = () => {
                        const savedCategories = JSON.parse(localStorage.getItem(LOCAL_STORAGE_KEY)) || [];

                        savedCategories.forEach(category => {
                            const newOption = document.createElement('option');
                            newOption.value = `${category.icon}|${category.name}`;
                            newOption.textContent = `${category.icon} ${category.name}`;

                            // Thêm vào đúng dropdown (chi tiêu hoặc thu nhập)
                            if (category.type === 'expense') {
                                expenseCategoryDropdown.appendChild(newOption);
                            }
                        });
                    };

                    // Gọi hàm tải các danh mục khi trang được tải
                    loadCategoriesFromLocalStorage();
                });
                //thu nhập 
                document.addEventListener('DOMContentLoaded', () => {
                    const incomeCategoryDropdown = document.getElementById('income-category'); // Dropdown danh mục thu nhập
                    const incomeCategoryModal = document.getElementById('income-category-modal'); // Modal danh mục thu nhập
                    const closeModalButton = document.getElementById('close-income-modal'); // Nút đóng modal
                    const createNewButton = document.getElementById('create-new-income'); // Nút tạo mới danh mục thu nhập
                    let clickTimer = null;

                    // Kiểm tra trạng thái modal từ localStorage khi tải lại trang
                    const modalState = localStorage.getItem('incomeCategoryModalState');
                    if (modalState === 'open') {
                        incomeCategoryModal.style.display = 'flex';
                    } else {
                        incomeCategoryModal.style.display = 'none';
                    }

                    // Lắng nghe sự kiện click để hiển thị modal danh mục thu nhập (double-click)
                    incomeCategoryDropdown.addEventListener('click', () => {
                        if (clickTimer !== null) {
                            // Nếu click thứ hai trong thời gian ngắn => double-click
                            clearTimeout(clickTimer); // Hủy bỏ timer
                            clickTimer = null;

                            // Hiển thị modal khi double-click
                            incomeCategoryModal.style.display = 'flex';

                            // Lưu trạng thái modal vào localStorage
                            localStorage.setItem('incomeCategoryModalState', 'open');
                        } else {
                            // Nếu chỉ click 1 lần
                            clickTimer = setTimeout(() => {
                                clickTimer = null; // Reset timer
                                console.log('Chọn danh mục thu nhập bình thường');
                            }, 300); // Chờ 300ms để phân biệt click đơn và double-click
                        }
                    });

                    // Đóng modal khi nhấn nút "×"
                    closeModalButton.addEventListener('click', () => {
                        incomeCategoryModal.style.display = 'none';

                        // Lưu trạng thái đóng modal vào localStorage
                        localStorage.setItem('incomeCategoryModalState', 'closed');
                    });

                    // Đóng modal khi click ra ngoài modal
                    incomeCategoryModal.addEventListener('click', (event) => {
                        if (event.target === incomeCategoryModal) {
                            incomeCategoryModal.style.display = 'none';

                            // Lưu trạng thái đóng modal vào localStorage
                            localStorage.setItem('incomeCategoryModalState', 'closed');
                        }
                    });

                    // Xử lý khi nhấn nút "Tạo mới"
                    createNewButton.addEventListener('click', () => {
                        incomeCategoryModal.style.display = 'flex';

                        // Lưu trạng thái modal khi mở
                        localStorage.setItem('incomeCategoryModalState', 'open');
                    });
                });

                document.addEventListener('DOMContentLoaded', () => {
    const createNewButtonIncome = document.getElementById('create-new-income'); // Nút tạo mới thu nhập
    const createCategoryModalIncome = document.getElementById('create-category-modal-income'); // Modal tạo danh mục thu nhập
    const closeCreateModalIncome = document.getElementById('close-create-modal-income'); // Nút đóng modal thu nhập

    // Hiển thị modal khi nhấn nút "Tạo mới"
    createNewButtonIncome.addEventListener('click', () => {
        createCategoryModalIncome.style.display = 'flex'; // Hiển thị modal
    });

    // Đóng modal khi nhấn nút "×"
    closeCreateModalIncome.addEventListener('click', () => {
        createCategoryModalIncome.style.display = 'none'; // Ẩn modal
    });

    // Đóng modal khi nhấn ra ngoài modal
    createCategoryModalIncome.addEventListener('click', (event) => {
        if (event.target === createCategoryModalIncome) {
            createCategoryModalIncome.style.display = 'none'; // Ẩn modal nếu click bên ngoài modal
        }
    });
});


                document.addEventListener('DOMContentLoaded', () => {
                    const iconPickerModalIncome = document.getElementById('icon-picker-modal-income');
                    const openIconPickerIncome = document.getElementById('open-icon-picker-income');
                    const iconPickerIncome = document.getElementById('icon-picker-income');
                    const iconPlaceholderIncome = document.querySelector('.category-icon-placeholder-income');
                    const submitCategoryButtonIncome = document.getElementById('submit-category-income');
                    const categoryNameInputIncome = document.getElementById('category-name-income');
                    const parentCategorySelectIncome = document.getElementById('parent-category-income');
                    const incomeCategoryDropdown = document.getElementById('income-category'); // Dropdown danh mục thu nhập
                    const categoryModalIncome = document.getElementById('create-category-modal-income');
                    const INCOME_LOCAL_STORAGE_KEY = 'incomeCategories'; // Khóa lưu trữ thu nhập

                    // Biểu tượng cho thu nhập
                    const incomeIcons = [
                        '💰', '💸', '📈', '💼', '🏠', '📊', '🎉', '🤑', '💎', '👔', '🏦', '💳', '🎁'
                    ];

                    // Render biểu tượng thu nhập
                    incomeIcons.forEach(icon => {
                        const iconElement = document.createElement('div');
                        iconElement.textContent = icon;
                        iconElement.setAttribute('data-icon', icon);
                        iconPickerIncome.appendChild(iconElement);

                        iconElement.addEventListener('click', () => {
                            iconPlaceholderIncome.textContent = icon;
                            iconPlaceholderIncome.setAttribute('data-icon', icon);
                            iconPickerModalIncome.style.display = 'none';
                        });
                    });

                    // Hiển thị modal chọn biểu tượng
                    openIconPickerIncome.addEventListener('click', () => {
                        iconPickerModalIncome.style.display = 'flex';
                    });

                    // Đóng modal khi click bên ngoài
                    document.addEventListener('click', (event) => {
                        if (!iconPickerModalIncome.contains(event.target) && event.target !== openIconPickerIncome) {
                            iconPickerModalIncome.style.display = 'none';
                        }
                    });


                    // Xử lý khi nhấn nút "Xác nhận"
                    // Thêm sự kiện click cho nút submit
                    submitCategoryButtonIncome.addEventListener('click', () => {
                        const categoryName = categoryNameInputIncome.value.trim();
                        const parentCategory = parentCategorySelectIncome.value;
                        const icon = iconPlaceholderIncome.getAttribute('data-icon');

                        if (!categoryName || !parentCategory || !icon) {
                            alert('Vui lòng điền đầy đủ thông tin.');
                            return;
                        }

                        const savedCategoriesIncome = JSON.parse(localStorage.getItem(INCOME_LOCAL_STORAGE_KEY)) || [];
                        const categoryExists = savedCategoriesIncome.some(category => category.name.toLowerCase() === categoryName.toLowerCase() && category.type === parentCategory);
                        if (categoryExists) {
                            alert('Danh mục này đã tồn tại. Vui lòng chọn tên khác.');
                            return;
                        }

                        savedCategoriesIncome.push({
                            icon,
                            name: categoryName,
                            type: parentCategory
                        });

                        localStorage.setItem(INCOME_LOCAL_STORAGE_KEY, JSON.stringify(savedCategoriesIncome));

                        const newOptionIncome = document.createElement('option');
                        newOptionIncome.value = `${icon}|${categoryName}`;
                        newOptionIncome.textContent = `${icon} ${categoryName}`;
                        incomeCategoryDropdown.appendChild(newOptionIncome);

                        categoryNameInputIncome.value = '';
                        parentCategorySelectIncome.value = '';
                        iconPlaceholderIncome.textContent = '';
                        iconPlaceholderIncome.removeAttribute('data-icon');
                        categoryModalIncome.style.display = 'none';

                        alert('Danh mục thu nhập mới đã được thêm thành công!');
                        const createCategoryModalIncome = document.getElementById('create-category-modal-income');
                        createCategoryModalIncome.style.display = 'none';
                    });

                    // Hàm tải các danh mục từ localStorage vào dropdown khi tải trang
                    const loadCategoriesFromLocalStorageIncome = () => {
                        const savedCategoriesIncome = JSON.parse(localStorage.getItem(INCOME_LOCAL_STORAGE_KEY)) || [];

                        savedCategoriesIncome.forEach(category => {
                            const newOptionIncome = document.createElement('option');
                            newOptionIncome.value = `${category.icon}|${category.name}`;
                            newOptionIncome.textContent = `${category.icon} ${category.name}`;
                            incomeCategoryDropdown.appendChild(newOptionIncome);
                        });
                    };

                    // Gọi hàm tải các danh mục khi trang được tải
                    loadCategoriesFromLocalStorageIncome();
                });

                
            </script>
</body>

</html>
