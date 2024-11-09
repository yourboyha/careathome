<?php
include 'chkadmin.php';

// ดึงข้อมูลทั้งหมดในคำสั่ง SQL เดียว
$sql = "
    SELECT 
        (SELECT COUNT(*) FROM users WHERE role = 'admin') AS total_admins,
        (SELECT COUNT(*) FROM users WHERE role = 'user') AS total_users,
        (SELECT COUNT(*) FROM service_ratings) AS total_reviews,
        (SELECT AVG(rating) FROM service_ratings) AS avg_rating,
        (SELECT COUNT(*) FROM threads) AS total_threads,
        (SELECT COUNT(*) FROM posts) AS total_posts
";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$admin_count = $data['total_admins'];
$user_count = $data['total_users'];
$total_reviews = $data['total_reviews'];
$avg_rating = round($data['avg_rating'], 2);
$total_threads = $data['total_threads'];
$total_posts = $data['total_posts'];
?>

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

  <a href="index.php" class="btn btn-secondary mb-3">กลับ</a>
</div>