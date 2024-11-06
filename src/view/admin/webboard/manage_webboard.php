<?php
session_start();
include "../../../controller/connect.php";

if ($_SESSION['role'] !== 'admin') {
  header("Location: /careathome/index.php?page=login");
  exit();
}

// ฟังก์ชันค้นหาข้อมูลกระทู้
$searchTerm = '';
if (isset($_POST['search'])) {
  $searchTerm = $_POST['search_term'];
}

// ดึงข้อมูลกระทู้จากฐานข้อมูล
$sql = "SELECT * FROM threads WHERE title LIKE '%$searchTerm%' OR content LIKE '%$searchTerm%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ผู้ดูแลระบบ - จัดการกระทู้ Webboard</title>
  <link rel="stylesheet" href="../../../../css/styles.css">
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
</head>

<body>
  <?php
  include "../../../../HeaderFooter/header.php";
  ?>

  <div class="container mt-5">
    <h1 class="mb-4 text-center">จัดการกระทู้ Webboard</h1>

    <!-- ฟอร์มค้นหาข้อมูล -->
    <form class="mb-4" method="POST" action="">
      <div class="input-group">
        <input type="text" class="form-control" name="search_term" placeholder="ค้นหากระทู้"
          value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button class="btn btn-primary" type="submit" name="search">ค้นหา</button>
      </div>
    </form>

    <a href="create_thread.php" class="btn btn-success mb-3">เพิ่มกระทู้</a>
    <!-- แสดงตารางกระทู้ -->
    <table class="table table-bordered table-striped">
      <thead class="thead-dark text-center">
        <tr>
          <th>รหัสกระทู้</th>
          <th>ชื่อกระทู้</th>
          <th>เนื้อหา</th>
          <th>วันที่สร้าง</th>
          <th>จัดการกระทู้</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['thread_id']) . "</td>";
            // เพิ่มลิงก์ไปยังหน้าแสดงโพสต์
            echo "<td><a href='view_thread.php?id=" . $row['thread_id'] . "'>" . htmlspecialchars($row['title']) . "</a></td>";
            echo "<td>" . htmlspecialchars($row['content']) . "</td>";
            echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
            echo "<td class='text-center'><a href='delete_thread.php?id=" . $row['thread_id'] . "' class='btn btn-danger' onclick='return confirm(\"คุณแน่ใจว่าต้องการลบกระทู้นี้?\");'>ลบ</a></td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='6' class='text-center'>ไม่มีข้อมูลกระทู้</td></tr>";
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