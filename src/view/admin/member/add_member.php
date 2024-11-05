<?php
session_start();
include "../../../controller/connect.php";
if ($_SESSION['role'] !== 'admin') {
  header("Location: /careathome/index.php?page=login");
  exit();
}

// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // แฮชรหัสผ่าน
  $email = $_POST['email'];
  $role = $_POST['role'];
  $fullname = $_POST['fullname'];
  $address = $_POST['address'];
  $telephone = $_POST['telephone'];

  // สร้างคำสั่ง SQL สำหรับเพิ่มผู้ใช้งาน
  $sql = "INSERT INTO users (username, password, email, role, fullname, address, telephone) VALUES ('$username', '$password', '$email', '$role', '$fullname', '$address', '$telephone')";

  if ($conn->query($sql) === TRUE) {
    // เพิ่มข้อมูลสำเร็จ
    header("Location: manage_members.php?success=1");
    exit();
  } else {
    // เกิดข้อผิดพลาด
    $error_message = $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>เพิ่มผู้ใช้งาน</title>
  <link rel="stylesheet" href="../../../../css/styles.css">
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
</head>

<body>
  <?php include "../../../../HeaderFooter/header.php"; ?>

  <div class="container mt-5 ">
    <h1 class="text-center mb-4">เพิ่มผู้ใช้งาน</h1>
    <form action="" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select class="form-select" id="role" name="role" required>
          <option value="">เลือกบทบาท</option>
          <option value="admin">Admin</option>
          <option value="user">User</option>
          <option value="staff">Staff</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="fullname" class="form-label">ชื่อผู้ใช้งาน</label>
        <input type="text" class="form-control" id="fullname" name="fullname" required>
      </div>
      <div class="mb-3">
        <label for="address" class="form-label">ที่อยู่</label>
        <input type="text" class="form-control" id="address" name="address" required>
      </div>
      <div class="mb-3">
        <label for="telephone" class="form-label">หมายเลขโทรศัพท์</label>
        <input type="tel" class="form-control" id="telephone" name="telephone" required>
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-primary">เพิ่มผู้ใช้งาน</button>
        <a href="manage_members.php" class="btn btn-secondary">กลับ</a>
      </div>
    </form>
  </div>

  <?php include "../../../../HeaderFooter/footer.php"; ?>

  <script src="../../../../js/bootstrap.bundle.min.js"></script>
</body>

</html>