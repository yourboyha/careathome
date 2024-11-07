<?php
include 'chkadmin.php';

// จัดการการเพิ่มแพ็คเกจ
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $package_name = $conn->real_escape_string($_POST['package_name']);
  $package_description = $conn->real_escape_string($_POST['package_description']);
  $cost = floatval($_POST['cost']);

  $sql = "INSERT INTO packages (package_name, package_description, cost) VALUES ('$package_name', '$package_description', '$cost')";
  if ($conn->query($sql) === TRUE) {
    header("Location: ?page=package");
    exit();
  } else {
    echo "เกิดข้อผิดพลาด: " . $conn->error;
  }
}
?>

<div class="container mt-5">
  <h2>เพิ่มแพ็คเกจใหม่</h2>
  <form method="POST" action="">
    <div class="form-group">
      <label for="package_name">ชื่อแพ็คเกจ</label>
      <input type="text" class="form-control" id="package_name" name="package_name" required>
    </div>
    <div class="form-group">
      <label for="package_description">รายละเอียดแพ็คเกจ</label>
      <textarea class="form-control" id="package_description" name="package_description" required></textarea>
    </div>
    <div class="form-group">
      <label for="cost">ค่าใช้จ่าย</label>
      <input type="number" class="form-control" id="cost" name="cost" required>
    </div>
    <button type="submit" class="btn btn-success">บันทึก</button>
    <a href="manage_package.php" class="btn btn-secondary">ยกเลิก</a>
  </form>
</div>