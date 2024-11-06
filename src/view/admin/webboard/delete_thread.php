<?php
session_start();
include "../../../controller/connect.php";

// ตรวจสอบสิทธิ์การเข้าถึงสำหรับผู้ใช้ที่มี role เป็น admin
if ($_SESSION['role'] !== 'admin') {
  header("Location: /careathome/index.php?page=login");
  exit();
}

// ตรวจสอบว่ามีการส่ง ID ของกระทู้มาหรือไม่
if (!isset($_GET['id'])) {
  header("Location: manage_webboard.php");
  exit();
}

// รับค่า ID ของกระทู้จาก URL และแปลงเป็น int
$thread_id = intval($_GET['id']);

// คำสั่ง SQL สำหรับลบโพสต์ทั้งหมดในกระทู้นี้
$delete_posts_sql = "DELETE FROM posts WHERE thread_id = $thread_id";
$conn->query($delete_posts_sql);

// คำสั่ง SQL สำหรับลบกระทู้
$delete_thread_sql = "DELETE FROM threads WHERE thread_id = $thread_id";
if ($conn->query($delete_thread_sql) === TRUE) {
  // ลบสำเร็จ, ย้อนกลับไปหน้าจัดการกระทู้
  header("Location: manage_webboard.php?message=deleted");
  exit();
} else {
  echo "เกิดข้อผิดพลาดในการลบกระทู้: " . $conn->error;
}

$conn->close();
