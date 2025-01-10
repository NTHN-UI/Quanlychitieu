<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khóa học Online</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .btn-primary {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            border: none;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: #4e54c8;
        }

        #course-content {
            display: none;
        }
    </style>
</head>

<body>
<nav>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="dashboard.blade.php" class="nav-link">Dashboard</a></li>
                <li class="nav-item"><a href="expense.blade.php" class="nav-link">Thu chi</a></li>
                <li class="nav-item"><a href="transaction.blade.php" class="nav-link">Sổ giao dịch</a></li>
                <li class="nav-item"><a href="remind.blade.php" class="nav-link">Nhắc nhở</a></li>
                <li class="nav-item"><a href="bugdget.blade.php" class="nav-link ">Ngân sách</a></li>
                <li class="nav-item"><a href="courses.blade.php" class="nav-link active">Khoá học</a></li>
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
    <div class="main-content"><div class="container">
        <h1 class="text-center mb-4">Danh sách Khóa học</h1>

        <!-- Danh sách khóa học -->
        <div class="row" id="course-list"></div>

        <h2 class="text-center mt-5">Khóa học của tôi</h2>
        <!-- Khóa học đã mua -->
        <div id="purchased-courses" class="row mt-3"></div>

        <!-- Nội dung khóa học -->
        <div id="course-content" class="mt-5">
            <h2>Nội dung khóa học</h2>
            <div id="content"></div>
        </div>
    </div></div>

    <script>
        // Danh sách khóa học
        const courses = [
            {
                id: 1,
                title: "Quản lý Tài chính Cá nhân",
                description: "Học cách quản lý thu nhập, chi tiêu và đầu tư hiệu quả.",
                price: 199000,
                image: "https://via.placeholder.com/300x200",
                video: "https://www.w3schools.com/html/mov_bbb.mp4",
                link: "https://www.investopedia.com/terms/f/financial-management.asp"
            },
                {
                id: 2,
                title: "Đầu tư Cơ bản",
                description: "Hướng dẫn đầu tư tài chính an toàn và hiệu quả cho người mới.",
                price: 299000,
                image: "https://via.placeholder.com/300x200",
                video: "https://www.w3schools.com/html/movie.mp4",
                link: "https://www.hsbc.com.vn/investments/financial-planning/personal-financial-management/"
            },
            {
                id: 3,
                title: "Thị trường Chứng khoán",
                description: "Những kiến thức cơ bản để bắt đầu đầu tư vào chứng khoán.",
                price: 399000,
                image: "https://via.placeholder.com/300x200",
                video: "https://www.w3schools.com/html/mov_bbb.mp4",
                link: "https://hpm.edu.vn/khoa_hoc_public/khoa-hoc-quan-ly-va-dau-tu-tai-chinh-ca-nhan-hieu-qua/"
            },
            {
                id: 4,
                title: "Tiết kiệm và Lập ngân sách",
                description: "Học cách lập kế hoạch ngân sách và tiết kiệm hiệu quả.",
                price: 249000,
                image: "https://via.placeholder.com/300x200",
                video: "https://www.w3schools.com/html/movie.mp4",
                link: "https://hpm.edu.vn/khoa_hoc_public/khoa-hoc-quan-ly-va-dau-tu-tai-chinh-ca-nhan-hieu-qua/"

            },
            {
                id: 5,
                title: "Kỹ năng Tài chính Cá nhân",
                description: "Khóa học toàn diện về tài chính cá nhân và lập kế hoạch dài hạn.",
                price: 459000,
                image: "https://via.placeholder.com/300x200",
                video: "https://www.w3schools.com/html/mov_bbb.mp4",
                link: "https://hpm.edu.vn/khoa_hoc_public/khoa-hoc-quan-ly-va-dau-tu-tai-chinh-ca-nhan-hieu-qua/ "        
            },
        ];

        // Hiển thị danh sách khóa học
        const courseList = document.getElementById("course-list");
        courses.forEach((course) => {
            const courseCard = `
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="${course.image}" class="card-img-top" alt="${course.title}">
                        <div class="card-body">
                            <h5 class="card-title">${course.title}</h5>
                            <p class="card-text">${course.description}</p>
                            <p class="text-danger">Giá: ${course.price.toLocaleString()} VND</p>
                            <button class="btn btn-primary" onclick="purchaseCourse(${course.id})">Mua ngay</button>
                        </div>
                    </div>
                </div>
            `;
            courseList.innerHTML += courseCard;
        });

        // Mua khóa học
        function purchaseCourse(courseId) {
            const selectedCourse = courses.find(course => course.id === courseId);

            let purchasedCourses = JSON.parse(localStorage.getItem('purchasedCourses')) || [];

            if (purchasedCourses.some(course => course.id === courseId)) {
                alert("Bạn đã mua khóa học này!");
                return;
            }

            purchasedCourses.push(selectedCourse);
            localStorage.setItem('purchasedCourses', JSON.stringify(purchasedCourses));

            alert(`Bạn đã mua khóa học: ${selectedCourse.title}`);
            showPurchasedCourses();
        }

        // Hiển thị khóa học đã mua
        function showPurchasedCourses() {
            const purchasedCourses = JSON.parse(localStorage.getItem('purchasedCourses')) || [];
            const purchasedCoursesContainer = document.getElementById('purchased-courses');

            purchasedCoursesContainer.innerHTML = '';
            if (purchasedCourses.length === 0) {
                purchasedCoursesContainer.innerHTML = '<p>Bạn chưa mua khóa học nào.</p>';
                return;
            }

            purchasedCourses.forEach(course => {
                const purchasedCard = `
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${course.title}</h5>
                                <p>${course.description}</p>
                                <button class="btn btn-primary" onclick="startCourse(${course.id})">Học ngay</button>
                            </div>
                        </div>
                    </div>
                `;
                purchasedCoursesContainer.innerHTML += purchasedCard;
            });
        }

        // Xem nội dung khóa học
        function startCourse(courseId) {
    const purchasedCourses = JSON.parse(localStorage.getItem('purchasedCourses')) || [];
    const course = purchasedCourses.find(course => course.id === courseId);

    if (!course) {
        alert("Khóa học này chưa được mua!");
        return;
    }

    document.getElementById('course-content').style.display = 'block';
    document.getElementById('content').innerHTML = `
        <h3>${course.title}</h3>
        <video controls width="100%" src="${course.video}"></video>
        <p class="mt-3">
            Xem thêm nội dung chi tiết tại: 
            <a href="${course.link}" target="_blank" rel="noopener noreferrer">
                Nhấn vào đây
            </a>
        </p>
    `;
}


        // Gọi hàm khi tải trang
        showPurchasedCourses();



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
