<?php
include 'chkadminid.php';

$thread_id = intval($_GET['id']);
$conn->query("DELETE FROM posts WHERE thread_id = $thread_id");
if ($conn->query("DELETE FROM threads WHERE thread_id = $thread_id") === TRUE) {
  header("Location: ?page=webboard&message=deleted");
  exit();
} else {
  echo "เกิดข้อผิดพลาดในการลบกระทู้: " . $conn->error;
}
