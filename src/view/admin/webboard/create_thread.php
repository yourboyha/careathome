<?php

// include 'chkadmin.php';

// ตรวจสอบผู้ใช้
if (!isset($_SESSION['user_id'])) {
  echo "user_id: ", $_SESSION['user_id'];
  // header("Location: /careathome/index.php?page=login");
  // exit();
}

// เมื่อมีการส่งฟอร์ม
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_SESSION['user_id'];
  $title = $_POST['title'];
  $content = $_POST['content'];

  // สร้างคำสั่ง SQL สำหรับเพิ่มกระทู้
  $sql = "INSERT INTO threads (user_id, title, content) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iss", $user_id, $title, $content);

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
  <form method="POST" action="">
    <div class="form-group">
      <label for="title">หัวข้อกระทู้:</label>
      <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
      <label for="content">เนื้อหากระทู้:</label>
      <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
    </div>
    <div class="text-center mb-3 mt-3">
      <button type="submit" class="btn btn-primary">ตั้งกระทู้</button>
      <a href="?page=webboard" class="btn btn-secondary">กลับ</a>
    </div>
  </form>
</div>