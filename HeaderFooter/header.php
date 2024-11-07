<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <!-- Navbar Brand -->
        <?php
        echo '<a class="navbar-brand" href="/careathome/">Care @ Home</a>';
        ?>
        <!-- Toggle button for small screens -->
        <button class="navbar-toggler" id="toggle-button" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="/careathome/index.php?page=home">หน้าหลัก</a></li>
                <li class="nav-item"><a class="nav-link active" href="/careathome/index.php?page=about">เกี่ยวกับเรา</a></li>
                <li class="nav-item"><a class="nav-link" href="/careathome/index.php?page=services">การให้บริการ</a></li>
                <li class="nav-item"><a class="nav-link" href="/careathome/index.php?page=contact">ติดต่อ</a></li>
            </ul>
        </div>

        <!-- User Section -->
        <div class="d-flex ms-auto align-items-center" id="user-section">
            <?php
            // session_start();
            // echo $_SESSION['username'];

            // ตรวจสอบสถานะการ login
            if (isset($_SESSION['username'])) {
                // แสดง dropdown สำหรับชื่อผู้ใช้
                echo '<div class="nav-item dropdown">';
                echo '<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="outline: 2px solid #68bbe3; outline-offset: 1px; border-radius: 4px; padding: 2px 4px;">';
                echo $_SESSION['username'];

                echo '</a>';
                echo '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">';
                switch ($_SESSION['role']) {
                    case 'admin': // แอดมิน
                        echo '<li><a class="dropdown-item" href="/careathome/src/view/admin/index.php">แดชบอร์ดแอดมิน</a></li>';
                        echo '<li><a class="dropdown-item" href="/careathome/src/view/admin/index.php?page=members">จัดการผู้ใช้งาน</a></li>';
                        echo '<li><a class="dropdown-item" href="/careathome/src/view/admin/index.php?page=package">จัดการแพคเกจ</a></li>';
                        echo '<li><a class="dropdown-item" href="/careathome/src/view/admin/index.php?page=pr">จัดการข่าวประชาสัมพันธ์</a></li>';
                        echo '<li><a class="dropdown-item" href="/careathome/src/view/admin/index.php?page=review">จัดการรีวิว</a></li>';
                        echo '<li><a class="dropdown-item" href="/careathome/src/view/admin/index.php?page=webboard">จัดการเว็บบอร์ด</a></li>';
                        echo '<li><a class="dropdown-item" href="/careathome/src/view/admin/index.php?page=report">ดูรายงาน</a></li>';
                        break;
                    case 'user': // ผู้ใช้งาน
                        echo '<li><a class="dropdown-item" href="/careathome/src/view/user/index.php">หน้าหลักผู้ใช้งาน</a></li>';
                        echo '<li><a class="dropdown-item" href="/careathome/src/view/user/index.php?page=profile">จัดการข้อมูลส่วนตัว</a></li>';
                        echo '<li><a class="dropdown-item" href="/careathome/src/view/user/index.php?page=patient">จัดการข้อมูลผู้สูงอายุ</a></li>';
                        echo '<li><a class="dropdown-item" href="/careathome/src/view/user/index.php?page=package">เลือกแพคเกจ</a></li>';
                        echo '<li><a class="dropdown-item" href="/careathome/src/view/user/index.php?page=webboard">เว็บบอร์ด</a></li>';
                        echo '<li><a class="dropdown-item" href="/careathome/src/view/user/index.php?page=review">รีวิว</a></li>';
                        break;
                }

                echo '<li><a class="dropdown-item" href="/careathome/logout.php">ออกจากระบบ</a></li>';
                echo '</ul>';
                echo '</div>';
            } else {
                // ถ้ายังไม่ได้ login
                echo '<div class="auth-links ms-auto">';
                echo '<a href="index.php?page=register" class="btn btn-outline-light me-2">สมัครสมาชิก</a>';
                echo '<a href="index.php?page=login" class="btn btn-outline-light">เข้าสู่ระบบ</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</nav>