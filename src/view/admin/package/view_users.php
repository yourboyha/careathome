<?php
include 'chkadmin.php';

$package_id = $_GET['package_id'];

// ดึงรายชื่อผู้ใช้ที่เลือกแพ็คเกจนี้
$sql_users = "SELECT u.user_id, u.fullname, u.email 
              FROM users u
              JOIN user_package up ON u.user_id = up.user_id
              WHERE up.package_id = ?";
$stmt = $conn->prepare($sql_users);
$stmt->bind_param("i", $package_id);
$stmt->execute();
$result_users = $stmt->get_result();
?>

<div class="container mt-5">
  <h1 class="mb-4 text-center">รายชื่อผู้ใช้ที่เลือกแพ็คเกจ</h1>

  <?php if ($result_users->num_rows > 0) : ?>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>รหัสผู้ใช้</th>
          <th>ชื่อผู้ใช้</th>
          <th>อีเมล</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($user = $result_users->fetch_assoc()) : ?>
          <tr>
            <td><?php echo htmlspecialchars($user['user_id']); ?></td>
            <td><?php echo htmlspecialchars($user['fullname']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else : ?>
    <p class="text-center">ไม่มีผู้ใช้เลือกแพ็คเกจนี้</p>
  <?php endif; ?>
  <div class="text-center mb-3">
    <a href="?page=package" class="btn btn-secondary mt-3">กลับไปยังหน้าจัดการแพ็คเกจ</a>
  </div>
</div>