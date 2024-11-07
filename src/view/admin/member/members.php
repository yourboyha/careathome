<?php
include 'chkadmin.php';

// ฟังก์ชันค้นหาข้อมูลผู้ใช้
$searchTerm = '';
$roleFilter = 'all'; // ตัวแปรสำหรับจัดเก็บบทบาทที่เลือก

if (isset($_POST['search'])) {
  $searchTerm = $_POST['search_term'];
}

if (isset($_POST['role'])) {
  $roleFilter = $_POST['role'];
}

// ดึงข้อมูลผู้ใช้งานจากฐานข้อมูลตามบทบาท
$sql = "SELECT * FROM users WHERE (username LIKE '%$searchTerm%' OR fullname LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%')";

if ($roleFilter !== 'all') {
  $sql .= " AND role = '$roleFilter'";
}

$result = $conn->query($sql);
?>


<div class="container mt-5">
  <h1 class="mb-4 text-center">จัดการผู้ใช้งาน</h1>

  <!-- ฟอร์มค้นหาข้อมูล -->
  <form class="mb-4" method="POST" action="">
    <div class="input-group mb-3">
      <input type="text" class="form-control" name="search_term" placeholder="ค้นหาชื่อผู้ใช้งาน, อีเมล หรือบทบาท"
        value="<?php echo htmlspecialchars($searchTerm); ?>">
      <button class="btn btn-primary" type="submit" name="search">ค้นหา</button>
    </div>
    <!-- ตัวเลือกบทบาท -->
    <div class="mb-3">
      <label for="role" class="form-label">เลือกบทบาท:</label>
      <select class="form-select" name="role" id="role">
        <option value="all" <?= $roleFilter == 'all' ? 'selected' : '' ?>>ทั้งหมด</option>
        <option value="admin" <?= $roleFilter == 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="user" <?= $roleFilter == 'user' ? 'selected' : '' ?>>User</option>
      </select>
      <button class="btn btn-info mt-2" type="submit">แสดงผล</button>
    </div>
  </form>

  <!-- ปุ่มเพิ่มสมาชิก -->
  <a href="?page=add_member" class="btn btn-success mb-3">เพิ่มสมาชิกใหม่</a>

  <!-- แสดงตารางข้อมูลผู้ใช้ -->
  <table class="table table-bordered table-striped">
    <thead class="thead-dark text-center">
      <tr>
        <th>รหัสผู้ใช้งาน</th>
        <th>ชื่อผู้ใช้งาน</th>
        <th>อีเมล</th>
        <th>บทบาท</th>
        <th colspan="2">จัดการข้อมูลผู้ใช้งาน</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
          echo "<td>" . htmlspecialchars($row['username']) . "</td>";
          echo "<td>" . htmlspecialchars($row['email']) . "</td>";
          echo "<td>" . htmlspecialchars($row['role']) . "</td>";
          echo "<td class='text-center'><a href='?page=edit_member&id=" . $row['user_id'] . "' class='btn btn-warning'>แก้ไข</a></td>";
          echo "<td class='text-center'><a href='?page=delete_member&id=" . $row['user_id'] . "' class='btn btn-danger' onclick='return confirm(\"คุณแน่ใจว่าต้องการลบสมาชิกนี้?\");'>ลบ</a></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='6' class='text-center'>ไม่มีข้อมูลผู้ใช้</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>