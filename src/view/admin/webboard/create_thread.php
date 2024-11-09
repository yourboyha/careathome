<?php
if (!isset($_SESSION['user_id'])) {
  echo "user_id: ", $_SESSION['user_id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $conn->prepare("INSERT INTO threads (user_id, title, content) VALUES (?, ?, ?)");
  $stmt->bind_param("iss", $_SESSION['user_id'], $_POST['title'], $_POST['content']);
  if ($stmt->execute()) {
    header("Location: ?page=webboard");
    exit();
  } else {
    echo "เกิดข้อผิดพลาด: " . $stmt->error;
  }
}
?>

<div class="container mt-5">
  <h1>ตั้งกระทู้ใหม่</h1>
  <form method="POST">
    <div class="form-group"><label for="title">หัวข้อกระทู้:</label><input type="text" class="form-control" name="title"
        required></div>
    <div class="form-group"><label for="content">เนื้อหากระทู้:</label><textarea class="form-control" name="content"
        rows="5" required></textarea></div>
    <div class="text-center mb-3 mt-3">
      <button type="submit" class="btn btn-primary">ตั้งกระทู้</button>
      <a href="?page=webboard" class="btn btn-secondary">กลับ</a>
    </div>
  </form>
</div>