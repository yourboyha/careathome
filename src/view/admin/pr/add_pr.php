<?php
session_start();
include "../../../controller/connect.php";

if ($_SESSION['role'] !== 'admin') {
    header("Location: /careathome/index.php?page=login");
    exit();
}

$title = $details = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $title = $_POST['title'];
    $details = $_POST['details'];
    $user_id = $_SESSION['user_id']; // ใช้ user_id จาก session ของผู้ใช้ที่เข้าสู่ระบบ

    // SQL สำหรับเพิ่มข้อมูลข่าวประชาสัมพันธ์
    $sql = "INSERT INTO pr (title, date, details, user_id) VALUES (?, CURDATE(), ?, ?)";
    
    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $details, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('เพิ่มข่าวประชาสัมพันธ์เรียบร้อย!'); window.location.href='manage_pr.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการเพิ่มข่าวประชาสัมพันธ์: " . $conn->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข่าวประชาสัมพันธ์</title>
    <link rel="stylesheet" href="../../../../css/styles.css">
    <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
</head>

<body>
    <?php include "../../../../HeaderFooter/header.php"; ?>

    <div class="container mt-5">
        <h1 class="text-center">เพิ่มข่าวประชาสัมพันธ์</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="title" class="form-label">หัวข้อข่าวประชาสัมพันธ์</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="details" class="form-label">รายละเอียดข่าวประชาสัมพันธ์</label>
                <textarea class="form-control" id="details" name="details" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">เพิ่มข่าวประชาสัมพันธ์</button>
            <a href="manage_pr.php" class="btn btn-secondary">กลับไปจัดการข่าวประชาสัมพันธ์</a>
        </form>
    </div>

    <?php include "../../../../HeaderFooter/footer.php"; ?>

    <script src="../../../../js/bootstrap.bundle.min.js"></script>
    <script src="../../../../js/script.js"></script>
</body>

</html>
