<?php
include 'chkadminid.php';

$user_id = $_GET['id'];

// ดึงข้อมูลผู้ใช้
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// ถ้าฟอร์มถูกส่ง
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $data = ['username', 'email', 'role', 'fullname', 'address', 'telephone'];
  $userData = [];
  foreach ($data as $field) $userData[$field] = $_POST[$field];

  // อัพเดตข้อมูลใน users
  $updateSql = "UPDATE users SET username = ?, email = ?, role = ?, fullname = ?, address = ?, telephone = ? WHERE user_id = ?";
  $stmt = $conn->prepare($updateSql);
  $stmt->bind_param(
    "ssssssi",
    $userData['username'],
    $userData['email'],
    $userData['role'],
    $userData['fullname'],
    $userData['address'],
    $userData['telephone'],
    $user_id
  );
  $updateSuccess = $stmt->execute();

  // ถ้า role เป็น user อัพเดตข้อมูลผู้สูงอายุ
  if ($user['role'] == 'user') {
    $patientData = ['patient_fullname', 'patient_info'];
    foreach ($patientData as $field) $patient[$field] = $_POST[$field];

    // อัพเดตหรือแทรกข้อมูลใน patient_info
    $patientSql = $patient ?
      "UPDATE patient_info SET fullname = ?, patient_info = ? WHERE user_id = ?" :
      "INSERT INTO patient_info (user_id, fullname, patient_info) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($patientSql);
    $stmt->bind_param(
      $patient ? "ssi" : "iss",
      $patient['patient_fullname'],
      $patient['patient_info'],
      $user_id
    );
    $updatePatientSuccess = $stmt->execute();
  }

  $message = ($updateSuccess && $updatePatientSuccess) ? "ข้อมูลถูกอัพเดตเรียบร้อย" : "เกิดข้อผิดพลาดในการอัพเดตข้อมูล";
  echo "<script>alert('$message'); window.location.href = '?page=members';</script>";
}
?>

<div class="container mt-3 mb-5">
  <h1 class="text-center">แก้ไขข้อมูลส่วนตัว</h1>

  <form method="POST">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($user['username']) ?>"
        readonly>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="role" class="form-label">Role</label>
      <select class="form-control" name="role" required>
        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="fullname" class="form-label">Fullname</label>
      <input type="text" class="form-control" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>"
        required>
    </div>
    <div class="mb-3">
      <label for="address" class="form-label">Address</label>
      <input type="text" class="form-control" name="address" value="<?= htmlspecialchars($user['address']) ?>" required>
    </div>
    <div class="mb-3">
      <label for="telephone" class="form-label">Telephone</label>
      <input type="text" class="form-control" name="telephone" value="<?= htmlspecialchars($user['telephone']) ?>"
        required>
    </div>

    <?php if ($user['role'] == 'user'): ?>
      <h2 class="text-center">ข้อมูลผู้สูงอายุ</h2>
      <div class="mb-3">
        <label for="patient_fullname" class="form-label">Patient Fullname</label>
        <input type="text" class="form-control" name="patient_fullname" value="<?= $patient['fullname'] ?? '' ?>"
          required>
      </div>
      <div class="mb-3">
        <label for="patient_info" class="form-label">Patient Info</label>
        <textarea class="form-control" name="patient_info" rows="3"
          required><?= $patient['patient_info'] ?? '' ?></textarea>
      </div>
    <?php endif; ?>

    <div class="text-center">
      <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
      <a href="?page=members" class="btn btn-secondary">กลับ</a>
    </div>
  </form>
</div>