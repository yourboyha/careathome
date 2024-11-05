<?php
session_start();
include "../../../controller/connect.php";

if ($_SESSION['role'] !== 'admin') {
    header("Location: /careathome/index.php?page=login");
    exit();
}

// ตรวจสอบว่ามีการส่ง ID ของข่าวประชาสัมพันธ์มาหรือไม่
if (!isset($_GET['id'])) {
    echo "<script>alert('ไม่พบข่าวประชาสัมพันธ์ที่ต้องการลบ'); window.location.href='manage_pr.php';</script>";
    exit();
}

// รับ ID ของข่าวประชาสัมพันธ์
$id = $_GET['id'];

// ลบข้อมูลข่าวประชาสัมพันธ์จากฐานข้อมูล
$sql = "DELETE FROM pr WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('ลบข่าวประชาสัมพันธ์เรียบร้อย!'); window.location.href='manage_pr.php';</script>";
} else {
    echo "<script>alert('เกิดข้อผิดพลาดในการลบข่าวประชาสัมพันธ์: " . $conn->error . "'); window.location.href='manage_pr.php';</script>";
}

$stmt->close();
$conn->close();
?>
