<?php
session_start();
include "../../controller/connect.php";
include 'chkadmin.php';
?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ผู้ดูแลระบบ</title>
  <link rel="stylesheet" href="../../../css/styles.css">
  <link rel="stylesheet" href="../../../css/bootstrap.min.css">
</head>

<body>
  <?php
  include "../../../HeaderFooter/header.php";

  // ตรวจสอบว่าได้รับค่า page จาก URL หรือไม่
  if (isset($_GET['page'])) {
    $page = $_GET['page'];
    // กรณีเลือกหน้าต่างๆ ของแอดมิน
    if ($page == 'members') {
      include "member/members.php";
    } else if ($page == 'add_member') {
      include "member/add_member.php";
    } else if ($page == 'edit_member') {
      include "member/edit_member.php";
    } else if ($page == 'delete_member') {
      include "member/delete_member.php";
    } else if ($page == 'pr') {
      include "pr/pr.php";
    } else if ($page == 'package') {
      include "package/package.php";
    } else if ($page == 'add_package') {
      include "package/add_package.php";
    } else if ($page == 'edit_package') {
      include "package/edit_package.php";
    } else if ($page == 'delete_package') {
      include "package/delete_package.php";
    } else if ($page == 'view_users') {
      include "package/view_users.php";
    } else if ($page == 'pr') {
      include "pr/pr.php";
    } else if ($page == 'add_pr') {
      include "pr/add_pr.php";
    } else if ($page == 'delete_pr') {
      include "pr/delete_pr.php";
    } else if ($page == 'edit_pr') {
      include "pr/edit_pr.php";
    } else if ($page == 'review') {
      include "review/review.php";
    } else if ($page == 'delete_review') {
      include "review/delete_review.php";
    } else if ($page == 'webboard') {
      include "webboard/webboard.php";
    } else if ($page == 'create_thread') {
      include "webboard/create_thread.php";
    } else if ($page == 'view_thread') {
      include "webboard/view_thread.php";
    } else if ($page == 'delete_thread') {
      include "webboard/delete_thread.php";
    } else if ($page == 'report') {
      include "report.php";
    } else {
      include "home.php";
    }
  } else {
    include "home.php";
  }
  ?>

  <?php
  include "../../../HeaderFooter/footer.php"
  ?>



</body>

</html>

<?php $conn->close(); ?>