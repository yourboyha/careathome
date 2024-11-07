<?php
include "chkss.php";  // ตรวจสอบ session

$user_id = $_SESSION['user_id'];  // รับค่า user_id จาก session

// ดึงข้อมูลแพ็คเกจที่ผู้ใช้เลือก
$sql = "SELECT p.package_name, p.package_description, p.cost 
        FROM packages p
        JOIN user_package up ON p.package_id = up.package_id
        WHERE up.user_id = '$user_id'";
$result = $conn->query($sql);

// ดึงข้อมูลแพ็คเกจทั้งหมดสำหรับการค้นหา
$searchTerm = '';
if (isset($_POST['search'])) {
  $searchTerm = $_POST['search_term'];
}

$sql_all_packages = "SELECT * FROM packages WHERE package_name LIKE '%$searchTerm%' OR package_description LIKE '%$searchTerm%'";
$result_all_packages = $conn->query($sql_all_packages);
?>

<div class="container mt-5">
  <h1 class="mb-4 text-center">แพ็คเกจที่คุณเลือก</h1>

  <?php
  if ($result->num_rows > 0) {
    // แสดงแพ็คเกจที่ผู้ใช้เลือก
    while ($row = $result->fetch_assoc()) {
      echo "<div class='row mb-4'>
                    <div class='col-md-12'>
                        <div class='card'>
                            <div class='card-body'>
                                <h5 class='card-title'>" . htmlspecialchars($row['package_name']) . "</h5>
                                <p class='card-text'>" . htmlspecialchars($row['package_description']) . "</p>
                                <p><strong>ราคา: </strong>" . htmlspecialchars($row['cost']) . " บาท</p>
                                <!-- ฟอร์มสำหรับลบแพ็คเกจที่เลือก -->
                                <form method='POST' action='delete_package.php'>
                                    <input type='hidden' name='user_id' value='" . $user_id . "'>
                                    <button type='submit' class='btn btn-danger'>ลบแพ็คเกจ</button>
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>";
    }
  } else {
    echo "<div class='col-12 text-center'>คุณยังไม่ได้เลือกแพ็คเกจใดๆ</div>";
  }
  ?>


  <h2 class="mb-4 text-center">เลือกแพ็คเกจใหม่</h2>

  <!-- ฟอร์มค้นหาข้อมูลแพ็คเกจ -->
  <form class="mb-4" method="POST" action="showpackage.php">
    <div class="input-group">
      <input type="text" class="form-control" name="search_term" placeholder="ค้นหาชื่อแพ็คเกจ"
        value="<?php echo htmlspecialchars($searchTerm); ?>">
      <button class="btn btn-primary" type="submit" name="search">ค้นหา</button>
    </div>
  </form>

  <!-- แสดงแพ็คเกจทั้งหมดในรูปแบบการ์ด -->
  <div class="row">
    <?php
    if ($result_all_packages->num_rows > 0) {
      while ($row = $result_all_packages->fetch_assoc()) {
        echo "<div class='col-md-4 mb-4'>
                        <div class='card'>
                            <div class='card-body'>
                                <h5 class='card-title'>" . htmlspecialchars($row['package_name']) . "</h5>
                                <p class='card-text'>" . htmlspecialchars($row['package_description']) . "</p>
                                <p><strong>ราคา: </strong>" . htmlspecialchars($row['cost']) . " บาท</p>
                                <form method='POST' action='select_package.php'>
                                    <input type='hidden' name='package_id' value='" . $row['package_id'] . "'>
                                    <button type='submit' class='btn btn-success'>เลือกแพ็คเกจ</button>
                                </form>
                            </div>
                        </div>
                    </div>";
      }
    } else {
      echo "<div class='col-12 text-center'>ไม่มีข้อมูลแพ็คเกจ</div>";
    }
    ?>
  </div>
</div>

<?php $conn->close(); ?>