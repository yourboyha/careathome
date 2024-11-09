<?php
include 'chkadmin.php';

// ดึงข้อมูลแพ็คเกจจากฐานข้อมูล
$searchTerm = $_POST['search_term'] ?? '';


$sql = "SELECT * FROM packages WHERE package_name LIKE '%$searchTerm%' OR package_description LIKE '%$searchTerm%'";
$result = $conn->query($sql);
?>

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
  <a href="?page=add_package" class="btn btn-success mb-2">เพิ่มแพ็คเกจใหม่</a>

  <!-- แสดงตารางข้อมูลแพ็คเกจ -->
  <table class="table table-bordered table-striped">
    <thead class="thead-dark text-center">
      <tr>
        <th>รหัสแพ็คเกจ</th>
        <th>ชื่อแพ็คเกจ</th>
        <th>รายละเอียด</th>
        <th>ราคา</th>
        <th style="width: 15%;">จำนวนผู้ใช้งาน</th>
        <th colspan="2">จัดการแพ็คเกจ</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          // ดึงจำนวนผู้ใช้ที่เลือกแพ็คเกจนี้
          $package_id = $row['package_id'];
          $sql_count = "SELECT COUNT(*) as user_count FROM user_package WHERE package_id = '$package_id'";
          $result_count = $conn->query($sql_count);
          $user_count = $result_count->fetch_assoc()['user_count'];

          echo "<tr>";
          echo "<td>" . htmlspecialchars($row['package_id']) . "</td>";
          echo "<td>" . htmlspecialchars($row['package_name']) . "</td>";
          echo "<td>" . htmlspecialchars($row['package_description']) . "</td>";
          echo "<td>" . htmlspecialchars($row['cost']) . " บาท</td>";
          echo "<td class='text-center'>
                  <a href='?page=view_users&package_id=" . $package_id . "' class='btn btn-info'>
                    ดู (" . $user_count . " คน)
                  </a>
                </td>";
          echo "<td class='text-center'><a href='?page=edit_package&id=" . $package_id . "' class='btn btn-warning'>แก้ไข</a></td>";
          echo "<td class='text-center'><a href='?page=delete_package&id=" . $package_id . "' class='btn btn-danger' onclick='return confirm(\"คุณแน่ใจว่าต้องการลบแพ็คเกจนี้?\");'>ลบ</a></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='7' class='text-center'>ไม่มีข้อมูลแพ็คเกจ</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>