<?php
include "chkss.php";
$user_id = $_SESSION['user_id']; // รับ user_id จาก session

// ตรวจสอบว่ามีข้อมูลผู้สูงอายุในฐานข้อมูลหรือไม่
$stmt = $conn->prepare("SELECT * FROM patient_info WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$patient = $result->fetch_assoc();
$has_patient = $result->num_rows > 0;

// กำหนดการทำงานเมื่อผู้ใช้ทำการบันทึกข้อมูล
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $patient_name = $_POST['patient_name'];
  $patient_condition = $_POST['patient_condition'];

  $sql = $has_patient
    ? "UPDATE patient_info SET fullname = ?, patient_info = ? WHERE user_id = ?"
    : "INSERT INTO patient_info (user_id, fullname, patient_info) VALUES (?, ?, ?)";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param($has_patient ? "ssi" : "iss", $user_id, $patient_name, $patient_condition);

  if ($stmt->execute()) {
    echo "<script>alert('บันทึกข้อมูลผู้สูงอายุสำเร็จ'); window.location.href='/careathome/src/view/user/index.php';</script>";
  } else {
    echo "<script>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล'); history.back();</script>";
  }
}
?>

<div id="patientInfo" class="container mt-3">
  <h1 class="text-center"><?= $has_patient ? "แก้ไขข้อมูลผู้สูงอายุ" : "เพิ่มข้อมูลผู้สูงอายุ" ?></h1>
  <!-- ฟอร์มแก้ไขหรือเพิ่มข้อมูลผู้สูงอายุ -->
  <form method="POST">
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
    <a href="index.php" class="btn btn-secondary">กลับ</a>
  </form>
</div>