<?php
include 'chkadmin.php';

// ฟังก์ชันค้นหาข้อมูลรีวิว
$searchTerm = $_POST['search_term'] ?? '';

// ดึงข้อมูลรีวิวจากฐานข้อมูล
$sql = "SELECT sr.*, u.fullname FROM service_ratings sr JOIN users u ON sr.user_id = u.user_id WHERE 
    u.fullname LIKE '%$searchTerm%' OR 
    sr.feedback LIKE '%$searchTerm%'";
$result = $conn->query($sql);
?>

<div class="container mt-5">
  <h1 class="mb-4 text-center">จัดการรีวิวและความคิดเห็น</h1>

  <!-- ฟอร์มค้นหาข้อมูล -->
  <form class="mb-4" method="POST" action="">
    <div class="input-group">
      <input type="text" class="form-control" name="search_term" placeholder="ค้นหาชื่อผู้รีวิวหรือความคิดเห็น"
        value="<?php echo htmlspecialchars($searchTerm); ?>">
      <button class="btn btn-primary" type="submit" name="search">ค้นหา</button>
    </div>
  </form>


  <!-- แสดงตารางรีวิว -->
  <table class="table table-bordered table-striped">
    <thead class="thead-dark text-center">
      <tr>
        <th>รหัสรีวิว</th>
        <th>ชื่อผู้รีวิว</th>
        <th>คะแนน</th>
        <th>ความคิดเห็น</th>
        <th colspan="2">จัดการรีวิว</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($row['rating_id']) . "</td>";
          echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
          echo "<td>" . htmlspecialchars($row['rating']) . " ดาว</td>";
          echo "<td>" . htmlspecialchars($row['feedback']) . "</td>";
          echo "<td class='text-center'><a href='?page=delete_review&id=" . $row['rating_id'] . "' class='btn btn-danger' onclick='return confirm(\"คุณแน่ใจว่าต้องการลบรีวิวนี้?\");'>ลบ</a></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='6' class='text-center'>ไม่มีข้อมูลรีวิว</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>