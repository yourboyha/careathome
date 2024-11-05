<?php
// logout.php
session_start(); // เริ่ม session

// ทำลาย session ทั้งหมดเพื่อลบข้อมูลการ login
session_unset();
session_destroy();

// เปลี่ยนเส้นทางไปที่หน้า login หรือหน้าหลักของเว็บไซต์
header("Location: index.php");
exit();

