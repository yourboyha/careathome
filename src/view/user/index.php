<?php
session_start();
include "../../controller/connect.php";
include "chkss.php";
?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>บริการดูแลผู้สูงอายุ</title>
  <link rel="stylesheet" href="/careathome/css/styles.css">
  <link rel="stylesheet" href="/careathome/css/bootstrap.min.css">
  <style>
    .list-group {
      margin-bottom: 20px;
    }

    .container {
      min-height: 80vh;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
    }
  </style>
</head>

<body>
  <?php
  include "../../../HeaderFooter/header.php";

  // หน้าในเว็บที่สามารถเลือกได้
  $pages = [
    'profile' => 'profile.php',
    'patient' => 'patient.php',
    'package' => 'package/package.php',
    'webboard' => 'webboard/webboard.php',
    'create_thread' => 'webboard/create_thread.php',
    'view_thread' => isset($_GET['id']) ? 'webboard/view_thread.php' : null,  // ตรวจสอบว่า 'id' มีหรือไม่
    'review' => 'review.php'
  ];

  // ตรวจสอบว่า 'page' ได้รับค่าหรือไม่
  $page = $_GET['page'] ?? 'home';  // หากไม่มีค่า 'page' ให้ใช้ 'home' เป็นค่าเริ่มต้น

  // เลือกแสดงหน้าตามค่าใน array $pages
  if (array_key_exists($page, $pages) && $pages[$page]) {
    include $pages[$page];
  } else {
    include "home.php";  // หากไม่มีหน้าตรงกับที่เลือก ให้แสดงหน้า home
  }

  include "../../../HeaderFooter/footer.php";
  ?>

</body>

</html>