<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
  header("Location: /careathome/index.php?page=login");
  exit();
}
?>


<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>บริการดูแลผู้สูงอายุ</title>
  <link rel="stylesheet" href="../../../css/styles.css">
  <link rel="stylesheet" href="../../../css/bootstrap.min.css">
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
      if ($page == 'showprofile') {
        include "home.php";
        echo '<div class="mb-4"></div>';
        include "profile/showprofile.php";
      } else if ($page == 'showpatient') {
        include "home.php";
        echo '<div class="mb-4"></div>';
        include "patient/showpatient.php";
      } else if ($page == 'showpackage') {
        include "home.php";
        echo '<div class="mb-4"></div>';
        include "showpackage.php";
      } else if ($page == 'review') {
        include "home.php";
        echo '<div class="mb-4"></div>';
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
  <script src="../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../js/script.js"></script>

</body>

</html>