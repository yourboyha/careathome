<?php

// ฟังก์ชันค้นหาข้อมูลกระทู้
$searchTerm = '';
if (isset($_POST['search'])) {
  $searchTerm = $_POST['search_term'];
}

// ดึงข้อมูลกระทู้และชื่อผู้ตั้งกระทู้จากฐานข้อมูล
$sql = "
  SELECT threads.*, Users.username 
  FROM threads 
  JOIN Users ON threads.user_id = Users.user_id 
  WHERE threads.title LIKE '%$searchTerm%' OR threads.content LIKE '%$searchTerm%'
";
$result = $conn->query($sql);
?>


<div class="container mt-5">
  <h1 class="mb-4 text-center">เว็บบอร์ด</h1>

  <!-- ฟอร์มค้นหาข้อมูล -->
  <form class="mb-4" method="POST" action="">
    <div class="input-group">
      <input type="text" class="form-control" name="search_term" placeholder="ค้นหากระทู้"
        value="<?php echo htmlspecialchars($searchTerm); ?>">
      <button class="btn btn-primary" type="submit" name="search">ค้นหา</button>
    </div>
  </form>

  <!-- ปุ่มเพิ่มกระทู้ (สำหรับผู้ใช้งานที่มีสิทธิ์) -->
  <?php if ($_SESSION['role'] === 'user'): ?>
    <a href="?page=create_thread" class="btn btn-success mb-3">เพิ่มกระทู้</a>
  <?php endif; ?>

  <!-- แสดงรายการกระทู้ -->
  <table class="table table-bordered table-striped">
    <thead class="thead-dark text-center">
      <tr>
        <th>ชื่อกระทู้</th>
        <th>ผู้ตั้งกระทู้</th>
        <th>วันที่สร้าง</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          // เพิ่มลิงก์ไปยังหน้าดูรายละเอียดกระทู้
          echo "<td><a href='index.php?page=view_thread&id=" . $row['thread_id'] . "'>" . htmlspecialchars($row['title']) . "</a></td>";
          echo "<td>" . htmlspecialchars($row['username']) . "</td>";  // แสดงชื่อผู้ตั้งกระทู้
          echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='3' class='text-center'>ไม่มีข้อมูลกระทู้</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<?php $conn->close(); ?>