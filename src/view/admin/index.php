<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: /careathome/index.php?page=login");
    exit();
}
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
    ?>


  <div class="container mt-5">
    <h1 class="text-center">ยินดีต้อนรับผู้ดูแลระบบ</h1>
    <div class="mb-4">
      <h2>จัดการข้อมูลผู้ใช้งาน</h2>
      <a href="member/manage_members.php" class="btn btn-primary btn-lg w-100">จัดการผู้ใช้งาน</a>
    </div>
    <div class="mb-4">
      <h2>จัดการส่วนประชาสัมพันธ์</h2>
      <a href="pr/manage_pr.php" class="btn btn-primary btn-lg w-100">จัดการประชาสัมพันธ์</a>
    </div>
    <div class="mb-4">
      <h2>จัดการแบบประเมิน</h2>
      <a href="review/manage_review.php" class="btn btn-primary btn-lg w-100">จัดการแบบประเมิน</a>
    </div>
    <div class="mb-4">
      <h2>จัดการเว็บบอร์ด</h2>
      <a href="webboard/manage_webboard.php" class="btn btn-primary btn-lg w-100">จัดการเว็บบอร์ด</a>
    </div>
    <div class="mb-4">
      <h2>ระบบรายงานผล</h2>
      <a href="report.php" class="btn btn-primary btn-lg w-100">ดูรายงาน</a>
    </div>
  </div>

  <?php
    include "../../../HeaderFooter/footer.php"
    ?>

  <script src="../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../js/script.js"></script>


</body>

</html>