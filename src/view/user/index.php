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
    /* ลด margin ด้านล่างของเมนู */
    .list-group {
      margin-bottom: 20px;
    }

    /* กำหนดความสูงของคอนเทนเนอร์เพื่อลดช่องว่าง */
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
  ?>
  <!-- ส่วนแสดงเนื้อหา -->
  <div id="contentDisplay" class="mt-4">
    <?php
    // ตรวจสอบว่า page มีการส่งค่ามาหรือไม่ และแสดงเนื้อหาตามที่เลือก
    if (isset($_GET['page'])) {
      $page = $_GET['page'];
      if ($page == 'profile') {
        include "showprofile.php";
      } else if ($page == 'patient') {
        include "showpatient.php";
      } else if ($page == 'package') {
        include "showpackage.php";
      } else if ($page == 'webboard') {
        include "webboard/show_webboard.php";
      } else if ($page == 'view_thread' && isset($_GET['id'])) {
        // ตรวจสอบว่ามี id กระทู้หรือไม่ก่อนแสดงรายละเอียดกระทู้
        include "webboard/view_thread.php";
      } else if ($page == 'review') {
        include "review.php";
      } else {
        include "home.php";
      }
    } else {
      include "home.php";
    }
    ?>
  </div>
  </div>
  <?php
  include "../../../HeaderFooter/footer.php"
  ?>

</body>

</html>