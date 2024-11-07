<?php
session_start();
include "../../../controller/connect.php";
include "chkss.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
  $user_id = intval($_POST['user_id']);

  // ลบแพ็คเกจที่ผู้ใช้เลือกจากตาราง user_package
  $sql_delete = "DELETE FROM user_package WHERE user_id = ?";
  $stmt_delete = $conn->prepare($sql_delete);
  $stmt_delete->bind_param("i", $user_id);

  if ($stmt_delete->execute()) {
    // หลังจากลบสำเร็จ ให้ส่งผู้ใช้งานกลับไปยังหน้าแพ็คเกจที่เลือก
    header("Location: /careathome/src/view/user/index.php?page=package&success=deleted");
    exit();
  } else {
    echo "<script>alert('เกิดข้อผิดพลาดในการลบแพ็คเกจ'); history.back();</script>";
  }
}
