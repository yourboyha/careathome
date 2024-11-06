<?php
session_start();
include "../../../controller/connect.php";

// ตรวจสอบสิทธิ์ผู้ใช้งาน
if ($_SESSION['role'] !== 'admin') {
  header("Location: /careathome/index.php?page=login");
  exit();
}

// ตรวจสอบว่ามีการส่ง rating_id มาหรือไม่
if (isset($_GET['id'])) {
  $rating_id = intval($_GET['id']);

  // เตรียมคำสั่ง SQL เพื่อลบรีวิว
  $sql = "DELETE FROM service_ratings WHERE rating_id = ?";

  // สร้าง prepared statement
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $rating_id);

  // ดำเนินการลบ
  if ($stmt->execute()) {
    // หากลบสำเร็จ ให้กลับไปยังหน้าจัดการรีวิว
    header("Location: manage_review.php");
    exit();
  } else {
    // หากเกิดข้อผิดพลาด
    echo "เกิดข้อผิดพลาดในการลบรีวิว: " . $conn->error;
  }

  // ปิด statement
  $stmt->close();
} else {
  echo "ไม่มีรหัสรีวิวที่ต้องการลบ.";
}

// ปิดการเชื่อมต่อ
$conn->close();
