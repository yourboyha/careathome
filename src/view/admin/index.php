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

  // หน้าแอดมินที่สามารถเลือกได้
  $pages = [
    'members' => 'member/members.php',
    'add_member' => 'member/add_member.php',
    'edit_member' => 'member/edit_member.php',
    'delete_member' => 'member/delete_member.php',
    'pr' => 'pr/pr.php',
    'package' => 'package/package.php',
    'add_package' => 'package/add_package.php',
    'edit_package' => 'package/edit_package.php',
    'delete_package' => 'package/delete_package.php',
    'view_users' => 'package/view_users.php',
    'add_pr' => 'pr/add_pr.php',
    'delete_pr' => 'pr/delete_pr.php',
    'edit_pr' => 'pr/edit_pr.php',
    'review' => 'review/review.php',
    'delete_review' => 'review/delete_review.php',
    'webboard' => 'webboard/webboard.php',
    'create_thread' => 'webboard/create_thread.php',
    'view_thread' => 'webboard/view_thread.php',
    'delete_thread' => 'webboard/delete_thread.php',
    'report' => 'report.php'
  ];

  // ตรวจสอบว่า 'page' ได้รับค่าหรือไม่
  $page = $_GET['page'] ?? 'home';  // หากไม่มีค่า 'page' ให้ใช้ 'home' เป็นค่าเริ่มต้น

  // แสดงหน้าที่เลือก
  if (array_key_exists($page, $pages)) {
    include $pages[$page];
  } else {
    include "home.php";  // หากไม่มีหน้าตรงกับที่เลือก ให้แสดงหน้า home
  }

  include "../../../HeaderFooter/footer.php"
  ?>
</body>

</html>
<?php $conn->close(); ?>