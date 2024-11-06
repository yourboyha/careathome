<?php
session_start();
include "../../../controller/connect.php";

if ($_SESSION['role'] !== 'admin') {
  header("Location: /careathome/index.php?page=login");
  exit();
}

// ฟังก์ชันค้นหาข้อมูลรีวิว
$searchTerm = '';
if (isset($_POST['search'])) {
  $searchTerm = $_POST['search_term'];
}

// ดึงข้อมูลรีวิวจากฐานข้อมูล
$sql = "SELECT * FROM webboard WHERE 
    title LIKE '%$searchTerm%' OR 
    content LIKE '%$searchTerm%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ผู้ดูแลระบบ - จัดการเว็บบอร์ด</title>
  <link rel="stylesheet" href="../../../../css/styles.css">
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
</head>

<body>
  <?php
  include "../../../../HeaderFooter/header.php";
  ?>

  <div class="container mt-5">
    <h1 class="mb-4 text-center">จัดการเว็บบอร์ด</h1>

    <!-- ฟอร์มค้นหาข้อมูล -->
    <form class="mb-4" method="POST" action="">
      <div class="input-group">
        <input type="text" class="form-control" name="search_term" placeholder="ค้นหาหัวข้อหรือเนื้อหา"
          value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button class="btn btn-primary" type="submit" name="search">ค้นหา</button>
      </div>
    </form>

    <!-- ปุ่มเพิ่มโพสต์ใหม่ -->
    <a href="add_webboard.php" class="btn btn-success mb-3">เพิ่มโพสต์ใหม่</a>

    <!-- แสดงตารางโพสต์เว็บบอร์ด -->
    <table class="table table-bordered table-striped">
      <thead class="thead-dark text-center">
        <tr>
          <th>รหัสโพสต์</th>
          <th>หัวข้อ</th>
          <th>วันที่</th>
          <th>เนื้อหา</th>
          <th colspan="2">จัดการโพสต์</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
            echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
            echo "<td>" . htmlspecialchars($row['content']) . "</td>";
            echo "<td class='text-center'><a href='edit_webboard.php?id=" . $row['id'] . "' class='btn btn-warning'>แก้ไข</a></td>";
            echo "<td class='text-center'><a href='delete_webboard.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"คุณแน่ใจว่าต้องการลบโพสต์นี้?\");'>ลบ</a></td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='6' class='text-center'>ไม่มีข้อมูลโพสต์ในเว็บบอร์ด</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <?php
  include "../../../../HeaderFooter/footer.php";
  ?>

  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/script.js"></script>

</body>

</html>

<?php $conn->close(); ?>