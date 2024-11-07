<?php
include "chkss.php";

$user_id = $_SESSION['user_id'];

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// ถ้าฟอร์มถูกส่ง
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // รับข้อมูลจากฟอร์ม
  $username = $_POST['username'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $fullname = $_POST['fullname'];
  $address = $_POST['address'];
  $telephone = $_POST['telephone'];

  echo $fullname;

  // อัพเดตข้อมูลในฐานข้อมูล
  $updateSql = "UPDATE users SET username = ?, email = ?, role = ?, fullname = ?, address = ?, telephone = ? WHERE user_id = ?";
  $updateStmt = $conn->prepare($updateSql);
  $updateStmt->bind_param("ssssssi", $username, $email, $role, $fullname, $address, $telephone, $user_id);

  if ($updateStmt->execute()) {
    // แสดง alert และ redirect
    echo "<script>
                alert('ข้อมูลถูกอัพเดตเรียบร้อย');
                window.location.href = '/careathome/src/view/user/index.php';
              </script>";
    exit();
  } else {
    $message = "เกิดข้อผิดพลาดในการอัพเดตข้อมูล";
  }
}
?>

<div class="container mt-3">
  <h1 class="text-center">แก้ไขข้อมูลส่วนตัว</h1>
  <?php if (isset($message)) { ?>
    <div class="alert alert-info"><?php echo $message; ?></div>
  <?php } ?>

  <form method="POST" action="index.php?page=profile">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username"
        value="<?= htmlspecialchars($user['username']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"
        required>
    </div>
    <div class="mb-3">
      <label for="role" class="form-label">Role</label>
      <select class="form-control" id="role" name="role" required>
        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="fullname" class="form-label">Fullname</label>
      <input type="text" class="form-control" id="fullname" name="fullname"
        value="<?= htmlspecialchars($user['fullname']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="address" class="form-label">Address</label>
      <input type="text" class="form-control" id="address" name="address"
        value="<?= htmlspecialchars($user['address']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="telephone" class="form-label">Telephone</label>
      <input type="text" class="form-control" id="telephone" name="telephone"
        value="<?= htmlspecialchars($user['telephone']) ?>" required>
    </div>
    <div class="mb-3">
      <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
      <a href="index.php" class="btn btn-secondary ">กลับ</a>
    </div>
  </form>
</div>