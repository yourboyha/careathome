<?php

include 'chkss.php';

// ตรวจสอบการส่งฟอร์มและบันทึกข้อมูลกระทู้ใหม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $content = $_POST['content'];
  $user_id = $_SESSION['user_id']; // สมมติว่ามี user_id ใน session

  // เพิ่มกระทู้ใหม่ลงในฐานข้อมูล
  $sql = "INSERT INTO threads (title, content, user_id, created_at) VALUES (?, ?, ?, NOW())";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssi", $title, $content, $user_id);

  if ($stmt->execute()) {
    // หากบันทึกสำเร็จ ให้กลับไปที่หน้าแสดงกระทู้
    header("Location: ?page=webboard");
    exit();
  } else {
    $error = "เกิดข้อผิดพลาดในการสร้างกระทู้ใหม่";
  }
}
?>

<div class="container mt-5">
  <h1 class="mb-4 text-center">สร้างกระทู้ใหม่</h1>

  <?php if (isset($error)) : ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $error; ?>
    </div>
  <?php endif; ?>

  <form method="POST" action="">
    <div class="mb-3">
      <label for="title" class="form-label">ชื่อกระทู้</label>
      <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
      <label for="content" class="form-label">เนื้อหา</label>
      <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">สร้างกระทู้</button>
    <a href="?page=webboard" class="btn btn-secondary">กลับไปยังเว็บบอร์ด</a>
  </form>
</div>