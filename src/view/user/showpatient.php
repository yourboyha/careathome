<?php
include "chkss.php";
$user_id = $_SESSION['user_id']; // รับ user_id จาก session

// ตรวจสอบว่ามีข้อมูลผู้สูงอายุในฐานข้อมูลหรือไม่
$sql = "SELECT * FROM patient_info WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$has_patient = $result->num_rows > 0;

// กำหนดการทำงานเมื่อผู้ใช้ทำการบันทึกข้อมูล
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $patient_name = $_POST['patient_name'];
  $patient_condition = $_POST['patient_condition'];

  if ($has_patient) {
    // กรณีที่มีข้อมูลผู้สูงอายุอยู่แล้ว ให้ทำการอัปเดต
    $sql_update = "UPDATE patient_info SET fullname = ?, patient_info = ? WHERE user_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssi", $patient_name, $patient_condition, $user_id);
  } else {
    // กรณีที่ยังไม่มีข้อมูลผู้สูงอายุ ให้ทำการเพิ่มข้อมูลใหม่
    $sql_insert = "INSERT INTO patient_info (user_id, fullname, patient_info) VALUES (?, ?, ?)";
    $stmt_update = $conn->prepare($sql_insert);
    $stmt_update->bind_param("iss", $user_id, $patient_name, $patient_condition);
  }

  if ($stmt_update->execute()) {
    echo "<script>alert('บันทึกข้อมูลผู้สูงอายุสำเร็จ'); window.location.href='/careathome/src/view/user/index.php';</script>";
  } else {
    echo "<script>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล'); history.back();</script>";
  }
} else if ($has_patient) {
  $patient = $result->fetch_assoc();
}
?>

<div id="patientInfo" class="container mt-3">
  <h1 class="text-center"><?= $has_patient ? "แก้ไขข้อมูลผู้สูงอายุ" : "เพิ่มข้อมูลผู้สูงอายุ" ?></h1>
  <!-- ฟอร์มแก้ไขหรือเพิ่มข้อมูลผู้สูงอายุ -->
  <form action="" method="POST">
    <?php if ($has_patient): ?>
      <input type="hidden" name="patient_id" value="<?= htmlspecialchars($patient['patient_id']) ?>">
    <?php endif; ?>

    <div class="mb-3">
      <label for="patient_name" class="form-label">ชื่อผู้สูงอายุ</label>
      <input type="text" id="patient_name" name="patient_name" class="form-control"
        value="<?= $has_patient ? htmlspecialchars($patient['fullname']) : "" ?>" required>
    </div>

    <div class="mb-3">
      <label for="patient_condition" class="form-label">ข้อมูลทั่วไปของผู้สูงอายุ</label>
      <textarea id="patient_condition" name="patient_condition" class="form-control" rows="3" required>
        <?= $has_patient ? htmlspecialchars(trim($patient['patient_info'])) : "" ?>
      </textarea>
    </div>

    <button type="submit" class="btn btn-primary">บันทึกข้อมูลผู้สูงอายุ</button>
    <a href="index.php" class="btn btn-secondary ">กลับ</a>
  </form>
</div>