<?php
session_start();
// echo $_SESSION['role_id'];
if (!isset($_SESSION['role'])) {
    header("Location: ../../../index.php?page=login"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บริการดูแลผู้สูงอายุ</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>

<body>
    <?php 
    include "../../HeaderFooter/header.php";

    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        // ตรวจสอบว่า page ที่ส่งเข้ามาคืออะไร
        if ($page == 'about') {
            include "../../view/admin/about.php";
        } else if ($page == 'services') {
            include "../../view/admin/services.php";
        } else if ($page == 'contact') {
            include "../../view/admin/contact.php";
        } else if ($page == 'forum') {
            include "../../view/admin/forum.php";
        } else if ($page == 'edit_profile') {
            include "../../view/edit_profile.php";
        } else if ($page == 'logout') {
            include "../../Controller/logout.php";
        } else {
            include "../../home.php";
        }
    } else {
        include "../../home.php"; // ค่าเริ่มต้นคือ home.php
    }
    ?>

  
    <div class="container mt-5">
    <h1>ยินดีต้อนรับคุณ <?php echo $_SESSION['username'];?></h1>
        <h2>จัดการข้อมูลสมาชิก</h2>
        <a href="manage_members.php" class="btn btn-primary">จัดการสมาชิก</a>
        
        <h2>จัดการส่วนประชาสัมพันธ์</h2>
        <a href="manage_announcements.php" class="btn btn-primary">จัดการประชาสัมพันธ์</a>
        
        <h2>จัดการแบบประเมิน</h2>
        <a href="manage_evaluations.php" class="btn btn-primary">จัดการแบบประเมิน</a>
        
        <h2>ระบบรายงานผล</h2>
        <a href="report.php" class="btn btn-primary">ดูรายงาน</a>
    </div>
    
    <?php
    include "HeaderFooter/footer.php"
    ?>

    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/script.js"></script>


</body>

</html>
