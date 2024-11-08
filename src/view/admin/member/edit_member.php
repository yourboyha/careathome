<?php
include 'chkadminid.php';

$user_id = $_GET['id'];

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// ตรวจสอบว่า role เป็น user เพื่อดึงข้อมูลจาก patient_info
$patient = null;  // กำหนดค่าเริ่มต้นเป็น null เพื่อเช็คข้อมูลในภายหลัง
if ($user['role'] == 'user') {
  $patientSql = "SELECT * FROM patient_info WHERE user_id = ?";
  $patientStmt = $conn->prepare($patientSql);
  $patientStmt->bind_param("i", $user_id);
  $patientStmt->execute();
  $patientResult = $patientStmt->get_result();
  $patient = $patientResult->fetch_assoc();
}

// ถ้าฟอร์มถูกส่ง
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // รับข้อมูลจากฟอร์ม
  $username = $_POST['username'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $fullname = $_POST['fullname'];
  $address = $_POST['address'];
  $telephone = $_POST['telephone'];

  // อัพเดตข้อมูลในตาราง users
  $updateSql = "UPDATE users SET username = ?, email = ?, role = ?, fullname = ?, address = ?, telephone = ? WHERE user_id = ?";
  $updateStmt = $conn->prepare($updateSql);
  $updateStmt->bind_param("ssssssi", $username, $email, $role, $fullname, $address, $telephone, $user_id);
  $updateSuccess = $updateStmt->execute();

  // อัพเดตหรือแทรกข้อมูลในตาราง patient_info ถ้า role เป็น user
  if ($user['role'] == 'user') {
    $patient_fullname = $_POST['patient_fullname'];
    $patient_info = $_POST['patient_info'];

    if ($patient) {
      // ถ้ามีข้อมูลอยู่แล้ว ให้อัพเดต
      $updatePatientSql = "UPDATE patient_info SET fullname = ?, patient_info = ? WHERE user_id = ?";
      $updatePatientStmt = $conn->prepare($updatePatientSql);
      $updatePatientStmt->bind_param("ssi", $patient_fullname, $patient_info, $user_id);
      $updatePatientSuccess = $updatePatientStmt->execute();
    } else {
      // ถ้าไม่มีข้อมูล ให้แทรกข้อมูลใหม่
      $insertPatientSql = "INSERT INTO patient_info (user_id, fullname, patient_info) VALUES (?, ?, ?)";
      $insertPatientStmt = $conn->prepare($insertPatientSql);
      $insertPatientStmt->bind_param("iss", $user_id, $patient_fullname, $patient_info);
      $updatePatientSuccess = $insertPatientStmt->execute();
    }
  }

  $message = ($updateSuccess && $updatePatientSuccess) ? "ข้อมูลถูกอัพเดตเรียบร้อย" : "เกิดข้อผิดพลาดในการอัพเดตข้อมูล";
}
?>

<div class="container mt-3 mb-5">
  <h1 class="text-center">แก้ไขข้อมูลส่วนตัว</h1>

  <?php if (isset($message)) { ?>
    <script type="text/javascript">
      alert("<?php echo $message; ?>");
      window.location.href = "index.php?page=members";
    </script>
  <?php } ?>

  <form method="POST" action="">
    <!-- ส่วนข้อมูลทั่วไป -->
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username_display"
        value="<?= htmlspecialchars($user['username']) ?>" disabled>
      <input type="hidden" name="username" value="<?= htmlspecialchars($user['username']) ?>">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"
        required>
    </div>
    <div class="mb-3">
      <label for="role" class="form-label">Role</label>
      <select class="form-control" id="role" name="role" required>
        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="fullname" class="form-label">Fullname</label>
      <input type="text" class="form-control" id="fullname" name="fullname"
        value="<?= htmlspecialchars($user['fullname']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="address" class="form-label">Address</label>
      <input type="text" class="form-control" id="address" name="address"
        value="<?= htmlspecialchars($user['address']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="telephone" class="form-label">Telephone</label>
      <input type="text" class="form-control" id="telephone" name="telephone"
        value="<?= htmlspecialchars($user['telephone']) ?>" required>
    </div>

    <!-- ส่วนข้อมูลผู้สูงอายุ (เฉพาะเมื่อ role เป็น user) -->
    <?php if ($user['role'] == 'user') { ?>
      <h2 class="text-center">ข้อมูลผู้สูงอายุ</h2>
      <div class="mb-3">
        <label for="patient_fullname" class="form-label">Patient Fullname</label>
        <input type="text" class="form-control" id="patient_fullname" name="patient_fullname"
          value="<?= isset($patient) ? htmlspecialchars($patient['fullname']) : '' ?>" required>
      </div>
      <div class="mb-3">
        <label for="patient_info" class="form-label">Patient Info</label>
        <textarea class="form-control" id="patient_info" name="patient_info" rows="3"
          required><?= isset($patient) ? htmlspecialchars($patient['patient_info']) : '' ?></textarea>
      </div>
    <?php } ?>

    <div class="text-center">
      <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
      <a href="?page=members" class="btn btn-secondary">กลับ</a>
    </div>
  </form>
</div>