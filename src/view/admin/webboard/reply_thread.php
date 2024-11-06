<?php
session_start();
include "../../../controller/connect.php";

// ตรวจสอบผู้ใช้
if (!isset($_SESSION['user_id'])) {
  header("Location: /careathome/index.php?page=login");
  exit();
}

// เมื่อมีการส่งฟอร์ม
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_SESSION['user_id'];
  $thread_id = $_POST['thread_id'];
  $content = $_POST['content'];

  // สร้างคำสั่ง SQL สำหรับเพิ่มการตอบ
  $sql = "INSERT INTO posts (thread_id, user_id, content) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iis", $thread_id, $user_id, $content);

  if ($stmt->execute()) {
    header("Location: view_thread.php?thread_id=" . $thread_id);
    exit();
  } else {
    echo "เกิดข้อผิดพลาด: " . $stmt->error;
  }
}
