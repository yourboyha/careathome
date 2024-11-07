<?php
include 'chkadminid.php';

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
    header("Location: ?page=view_thread&thread_id=" . $thread_id);
    exit();
  } else {
    echo "เกิดข้อผิดพลาด: " . $stmt->error;
  }
}
