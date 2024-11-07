<?php
session_start();
include "../../../controller/connect.php";
include "chkss.php";  // ตรวจสอบ session

$user_id = $_SESSION['user_id'];  // รับค่า user_id จาก session

// ตรวจสอบการเลือกแพ็คเกจและบันทึกลงฐานข้อมูล
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['package_id'])) {
    $package_id = intval($_POST['package_id']);  // รับค่า package_id ที่ผู้ใช้เลือก

    // ตรวจสอบว่าผู้ใช้เลือกแพ็คเกจแล้วในตาราง user_package
    $sql_check = "SELECT * FROM user_package WHERE user_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $user_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
      // หากมีการเลือกแพ็คเกจแล้ว, อัปเดตแพ็คเกจที่เลือกใหม่
      $sql_update = "UPDATE user_package SET package_id = ? WHERE user_id = ?";
      $stmt_update = $conn->prepare($sql_update);
      $stmt_update->bind_param("ii", $package_id, $user_id);
      $stmt_update->execute();
    } else {
      // หากยังไม่มีการเลือกแพ็คเกจ, บันทึกแพ็คเกจใหม่
      $sql_insert = "INSERT INTO user_package (user_id, package_id) VALUES (?, ?)";
      $stmt_insert = $conn->prepare($sql_insert);
      $stmt_insert->bind_param("ii", $user_id, $package_id);
      $stmt_insert->execute();
    }
  } elseif (isset($_POST['delete_package'])) {
    // ลบแพ็คเกจที่ผู้ใช้เลือกออก
    $sql_delete = "DELETE FROM user_package WHERE user_id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $user_id);
    $stmt_delete->execute();
  }
}

// เปลี่ยนเส้นทางกลับไปยังหน้าแสดงแพ็คเกจที่เลือก
header("Location: /careathome/src/view/user/index.php?page=package");
exit;
