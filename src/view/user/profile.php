<?php
// ตรวจสอบการเข้าสู่ระบบของผู้ใช้งาน
include "chkss.php";

$user_id = $_SESSION['user_id'];

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// อัพเดตข้อมูลเมื่อฟอร์มถูกส่ง
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // เตรียมคำสั่ง sql *** สำคัญ ถ้าคำสั่งผิด จะเพิ่มข้อมูลในฐานข้อมูลไม่ได้ *** 
  $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, fullname = ?, address = ?, telephone = ? WHERE user_id = ?");
  // เชื่อมโยงข้อมูลเข้ากับ sql 
  $stmt->bind_param("sssssi", $_POST['username'], $_POST['email'], $_POST['fullname'], $_POST['address'], $_POST['telephone'], $user_id);
  // สั่งให้ sql ทำงาน
  if ($stmt->execute()) {
    // กรณีที่เพิ่มสำเร็จ
    echo "<script>
                alert('ข้อมูลถูกอัพเดตเรียบร้อย');
                window.location.href = '/careathome/src/view/user/index.php';
              </script>";
    exit();
  } else {
    // กรณีที่เพิ่มไม่สำเร็จ
    $message = "เกิดข้อผิดพลาดในการอัพเดตข้อมูล";
  }
}
?>
<!-- ส่วนแสดงฟอร์มข้อมูลส่วนตัว -->
<div class="container mt-3">
  <h1 class="text-center">แก้ไขข้อมูลส่วนตัว</h1>
  <?php if (isset($message)) { ?>
  <div class="alert alert-info"><?php echo $message; ?></div>
  <?php } ?>
  <!-- เริ่มต้นฟอร์ม -->
  <form method="POST" action="index.php?page=profile">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username"
        value="<?= htmlspecialchars($user['username']) ?>" readonly>
    </div>
    <!-- เตรียมข้อมูลที่เรียกมาจากฐานข้อมูลมาเก็บในตัวแปร field -->
    <?php foreach (['email', 'fullname', 'address', 'telephone'] as $field) { ?>
    <div class="mb-3">
      <!-- เรียกข้อมูลจาก field มาแสดง ('email', 'fullname', 'address', 'telephone') -->
      <label for="<?= $field ?>" class="form-label"><?= ucfirst($field) ?></label>
      <input type="<?= $field == 'email' ? 'email' : 'text' ?>" class="form-control" id="<?= $field ?>"
        name="<?= $field ?>" value="<?= htmlspecialchars($user[$field]) ?>" required>
    </div>
    <?php } ?>
    <!-- สิทธิ์ผู้ใช้งาน -->
    <div class="mb-3">
      <label for="role" class="form-label">Role</label>
      <select class="form-control" id="role" name="role" disabled>
        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
      </select>
    </div>
    <!-- ปุ่ม -->
    <div class="mb-3">
      <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
      <a href="index.php" class="btn btn-secondary">กลับ</a>
    </div>
  </form>
</div>