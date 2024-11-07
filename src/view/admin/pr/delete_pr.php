<?php
include 'chkadminid.php';

// รับ ID ของข่าวประชาสัมพันธ์
$id = $_GET['id'];

// ลบข้อมูลข่าวประชาสัมพันธ์จากฐานข้อมูล
$sql = "DELETE FROM pr WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('ลบข่าวประชาสัมพันธ์เรียบร้อย!'); window.location.href='?page=pr';</script>";
} else {
    echo "<script>alert('เกิดข้อผิดพลาดในการลบข่าวประชาสัมพันธ์: " . $conn->error . "'); window.location.href='?page=pr';</script>";
}

$stmt->close();
$conn->close();
