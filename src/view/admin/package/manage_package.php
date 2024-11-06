<?php
session_start();
include "../../../controller/connect.php";

if ($_SESSION['role'] !== 'admin') {
  header("Location: /careathome/index.php?page=login");
  exit();
}

// ดึงข้อมูลแพ็คเกจจากฐานข้อมูล
$searchTerm = '';
if (isset($_POST['search'])) {
  $searchTerm = $_POST['search_term'];
}

$sql = "SELECT * FROM packages WHERE package_name LIKE '%$searchTerm%' OR package_description LIKE '%$searchTerm%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ผู้ดูแลระบบ - จัดการแพ็คเกจ</title>
  <link rel="stylesheet" href="../../../../css/styles.css">
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
</head>

<body>
  <?php include "../../../../HeaderFooter/header.php"; ?>

  <div class="container mt-5">
    <h1 class="mb-4 text-center">จัดการแพ็คเกจ</h1>

    <!-- ฟอร์มค้นหาข้อมูลแพ็คเกจ -->
    <form class="mb-4" method="POST" action="">
      <div class="input-group">
        <input type="text" class="form-control" name="search_term" placeholder="ค้นหาชื่อแพ็คเกจ"
          value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button class="btn btn-primary" type="submit" name="search">ค้นหา</button>
      </div>
    </form>

    <!-- ปุ่มเพิ่มแพ็คเกจ -->
    <a href="add_package.php" class="btn btn-success mb-3">เพิ่มแพ็คเกจใหม่</a>

    <!-- แสดงตารางข้อมูลแพ็คเกจ -->
    <table class="table table-bordered table-striped">
      <thead class="thead-dark text-center">
        <tr>
          <th>รหัสแพ็คเกจ</th>
          <th>ชื่อแพ็คเกจ</th>
          <th>รายละเอียด</th>
          <th>ราคา</th>
          <th colspan="2">จัดการแพ็คเกจ</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['package_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['package_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['package_description']) . "</td>";
            echo "<td>" . htmlspecialchars($row['cost']) . " บาท</td>";
            echo "<td class='text-center'><a href='edit_package.php?id=" . $row['package_id'] . "' class='btn btn-warning'>แก้ไข</a></td>";
            echo "<td class='text-center'><a href='delete_package.php?id=" . $row['package_id'] . "' class='btn btn-danger' onclick='return confirm(\"คุณแน่ใจว่าต้องการลบแพ็คเกจนี้?\");'>ลบ</a></td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='6' class='text-center'>ไม่มีข้อมูลแพ็คเกจ</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <?php include "../../../../HeaderFooter/footer.php"; ?>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/script.js"></script>

</body>

</html>

<?php $conn->close(); ?>