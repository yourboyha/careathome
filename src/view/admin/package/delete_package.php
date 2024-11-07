<?php
include 'chkadminid.php';

if (isset($_GET['id'])) {
  $package_id = intval($_GET['id']);

  $sql = "DELETE FROM packages WHERE package_id = $package_id";
  if ($conn->query($sql) === TRUE) {
    header("Location: ?page=package");
    exit();
  } else {
    echo "เกิดข้อผิดพลาด: " . $conn->error;
  }
} else {
  header("Location: ?page=package");
  exit();
}
