<?php
session_start();
include "../../controller/connect.php";

if ($_SESSION['role'] !== 'admin') {
  header("Location: /careathome/index.php?page=login");
  exit();
}

// ดึงข้อมูลสรุปของสมาชิก
$admin_count_sql = "SELECT COUNT(*) as total_admins FROM users WHERE role = 'admin'";
$user_count_sql = "SELECT COUNT(*) as total_users FROM users WHERE role = 'user'";
$admin_count_result = $conn->query($admin_count_sql);
$user_count_result = $conn->query($user_count_sql);
$admin_count = $admin_count_result->fetch_assoc()['total_admins'];
$user_count = $user_count_result->fetch_assoc()['total_users'];

// ดึงข้อมูลสรุปรีวิว
$reviews_sql = "SELECT COUNT(*) as total_reviews, AVG(rating) as avg_rating FROM service_ratings";
$reviews_result = $conn->query($reviews_sql);
$reviews_data = $reviews_result->fetch_assoc();
$total_reviews = $reviews_data['total_reviews'];
$avg_rating = round($reviews_data['avg_rating'], 2);

// ดึงข้อมูลสรุปการถามตอบในกระทู้
$threads_sql = "SELECT COUNT(*) as total_threads FROM threads";
$posts_sql = "SELECT COUNT(*) as total_posts FROM posts";
$threads_result = $conn->query($threads_sql);
$posts_result = $conn->query($posts_sql);
$total_threads = $threads_result->fetch_assoc()['total_threads'];
$total_posts = $posts_result->fetch_assoc()['total_posts'];
?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>รายงานสรุป - Webboard</title>
  <link rel="stylesheet" href="../../../css/styles.css">
  <link rel="stylesheet" href="../../../css/bootstrap.min.css">
</head>

<body>
  <?php include "../../../HeaderFooter/header.php"; ?>

  <div class="container mt-5">
    <h1 class="text-center mb-4">รายงานสรุปข้อมูลระบบ</h1>

    <!-- ข้อมูลสรุปสมาชิก -->
    <div class="card mb-4">
      <div class="card-header bg-primary text-white">ข้อมูลสมาชิก</div>
      <div class="card-body">
        <p><strong>จำนวนแอดมิน:</strong> <?php echo $admin_count; ?></p>
        <p><strong>จำนวนผู้ใช้งานทั่วไป:</strong> <?php echo $user_count; ?></p>
        <p><strong>จำนวนสมาชิกทั้งหมด:</strong> <?php echo $admin_count + $user_count; ?></p>
      </div>
    </div>

    <!-- ข้อมูลสรุปรีวิว -->
    <div class="card mb-4">
      <div class="card-header bg-success text-white">ข้อมูลรีวิว</div>
      <div class="card-body">
        <p><strong>จำนวนรีวิวทั้งหมด:</strong> <?php echo $total_reviews; ?></p>
        <p><strong>คะแนนรีวิวเฉลี่ย:</strong> <?php echo $avg_rating; ?></p>
      </div>
    </div>

    <!-- ข้อมูลสรุปการถามตอบในกระทู้ -->
    <div class="card mb-4">
      <div class="card-header bg-info text-white">ข้อมูลการถามตอบในกระทู้</div>
      <div class="card-body">
        <p><strong>จำนวนกระทู้ทั้งหมด:</strong> <?php echo $total_threads; ?></p>
        <p><strong>จำนวนโพสต์ทั้งหมด:</strong> <?php echo $total_posts; ?></p>
      </div>
    </div>

    <a href="manage_webboard.php" class="btn btn-secondary mt-3">กลับไปยังหน้าจัดการกระทู้</a>
  </div>

  <?php include "../../../HeaderFooter/footer.php"; ?>

  <script src="../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../js/script.js"></script>
</body>

</html>

<?php $conn->close(); ?>