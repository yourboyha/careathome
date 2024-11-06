<?php
session_start();
include "../../../controller/connect.php";

if ($_SESSION['role'] !== 'admin') {
  header("Location: /careathome/index.php?page=login");
  exit();
}

$package_id = intval($_GET['id']);
$sql = "SELECT * FROM packages WHERE package_id = $package_id";
$result = $conn->query($sql);
$package = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $package_name = $conn->real_escape_string($_POST['package_name']);
  $package_description = $conn->real_escape_string($_POST['package_description']);
  $cost = floatval($_POST['cost']);

  $sql = "UPDATE packages SET package_name='$package_name', package_description='$package_description', cost='$cost' WHERE package_id=$package_id";
  if ($conn->query($sql) === TRUE) {
    header("Location: manage_package.php");
    exit();
  } else {
    echo "เกิดข้อผิดพลาด: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>แก้ไขแพ็คเกจ</title>
  <link rel="stylesheet" href="../../../../css/styles.css">
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
</head>

<body>

  <?php include "../../../../HeaderFooter/header.php"; ?>
  <div class="container mt-5">
    <h2>แก้ไขแพ็คเกจ</h2>
    <form method="POST" action="">
      <div class="form-group">
        <label for="package_name">ชื่อแพ็คเกจ</label>
        <input type="text" class="form-control" id="package_name" name="package_name"
          value="<?php echo htmlspecialchars($package['package_name']); ?>" required>
      </div>
      <div class="form-group">
        <label for="package_description">รายละเอียดแพ็คเกจ</label>
        <textarea class="form-control" id="package_description" name="package_description"
          required><?php echo htmlspecialchars($package['package_description']); ?></textarea>
      </div>
      <div class="form-group">
        <label for="cost">ค่าใช้จ่าย</label>
        <input type="number" class="form-control" id="cost" name="cost"
          value="<?php echo htmlspecialchars($package['cost']); ?>" required>
      </div>
      <button type="submit" class="btn btn-primary">อัปเดต</button>
      <a href="manage_package.php" class="btn btn-secondary">ยกเลิก</a>
    </form>
  </div>
  <?php include "../../../../HeaderFooter/footer.php"; ?>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/script.js"></script>
</body>

</html>