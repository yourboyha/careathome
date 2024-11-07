<?php

// ตรวจสอบว่า user ได้เข้าสู่ระบบแล้วหรือไม่
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
  header("Location: /careathome/index.php?page=login");
  exit();
}
