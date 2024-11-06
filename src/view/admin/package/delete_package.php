<?php
session_start();
include "../../../controller/connect.php";

if ($_SESSION['role'] !== 'admin') {
  header("Location: /careathome/index.php?page=login");
  exit();
}

if (isset($_GET['id'])) {
  $package_id = intval($_GET['id']);

  $sql = "DELETE FROM packages WHERE package_id = $package_id";
  if ($conn->query($sql) === TRUE) {
    header("Location: manage_package.php");
    exit();
  } else {
    echo "เกิดข้อผิดพลาด: " . $conn->error;
  }
} else {
  header("Location: manage_package.php");
  exit();
}
