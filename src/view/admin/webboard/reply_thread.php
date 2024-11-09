<?php
include 'chkadminid.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $conn->prepare("INSERT INTO posts (thread_id, user_id, content) VALUES (?, ?, ?)");
  $stmt->bind_param("iis", $_POST['thread_id'], $_SESSION['user_id'], $_POST['content']);

  if ($stmt->execute()) {
    header("Location: ?page=view_thread&thread_id=" . $_POST['thread_id']);
    exit();
  } else {
    echo "เกิดข้อผิดพลาด: " . $stmt->error;
  }
}
