<?php
// ดึงข้อมูลข่าวประชาสัมพันธ์และแพ็คเกจ
$sql_pr = "SELECT * FROM pr ORDER BY date DESC";
$sql_packages = "SELECT * FROM packages";
$sql_reviews = "SELECT u.fullname AS reviewer_name, r.rating, r.feedback
                FROM service_ratings AS r
                JOIN users AS u ON r.user_id = u.user_id
                ORDER BY r.created_at DESC";
$result_pr = $conn->query($sql_pr);
$result_all_packages = $conn->query($sql_packages);
$result_reviews = $conn->query($sql_reviews);
?>


<!-- แบนเนอร์ -->
<section class="banner">
  <h1>การดูแลที่อบอุ่น เริ่มต้นที่นี่</h1>
</section>
<!-- ส่วนข้อมูลประชาสัมพันธ์ -->
<h2 class="text-center mt-3 mb-3">ประชาสัมพันธ์บริการ</h2>
<div class="container">
  <div class="row">
    <?php if ($result_pr->num_rows > 0): ?>
    <?php $counter = 0;
            while ($row = $result_pr->fetch_assoc()): ?>
    <?php if ($counter % 2 == 0 && $counter > 0) echo "</div><div class='row'>"; ?>
    <div class="col-md-6 mb-2">
      <article class="border p-2">
        <h3><?= htmlspecialchars($row['title']) ?></h3>
        <p><?= htmlspecialchars($row['details']) ?></p>
      </article>
    </div>
    <?php $counter++;
            endwhile; ?>
    <?php else: ?>
    <p>ยังไม่มีข่าวประชาสัมพันธ์</p>
    <?php endif; ?>
  </div>
</div>


<!-- ส่วนแพคเกจที่ให้บริการ -->
<h2 class="text-center mt-3 mb-3">แพคเกจที่ให้บริการ</h2>
<div class="container">
  <div class="row">
    <?php while ($row = $result_all_packages->fetch_assoc()): ?>
    <div class="col-md-4 mb-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?= htmlspecialchars($row['package_name']) ?></h5>
          <p class="card-text"><?= htmlspecialchars($row['package_description']) ?></p>
          <p><strong>ราคา: </strong><?= htmlspecialchars($row['cost']) ?> บาท</p>
          <form method="POST" action="select_package.php">
            <input type="hidden" name="package_id" value="<?= $row['package_id'] ?>">
            <button type="submit" class="btn btn-success">เลือกแพ็คเกจ</button>
          </form>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>

<!-- ส่วนให้คะแนนบริการ -->

<h2 class="text-center mt-3 mb-3">รีวิวและความคิดเห็น</h2>
<div class="container">
  <div class="row">
    <?php if ($result_reviews->num_rows > 0): ?>
    <?php while ($row = $result_reviews->fetch_assoc()): ?>
    <div class="col-md-4 mb-2">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title"><?= htmlspecialchars($row['reviewer_name']) ?></h5>
          <h6 class="card-subtitle mb-2 text-muted">Rating: <?= htmlspecialchars($row['rating']) ?> ดาว</h6>
          <p class="card-text"><?= htmlspecialchars($row['feedback']) ?></p>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
    <?php else: ?>
    <p class="text-center">ยังไม่มีรีวิวในขณะนี้</p>
    <?php endif; ?>
  </div>
</div>

<!-- ส่วนสถิติผู้เข้าชม -->
<section class="text-center mt-3 mb-3">
  <h2>สถิติผู้เข้าชม</h2>
  <p>มีผู้เข้าชมแล้ว: <?php include("counter.php"); ?> ครั้ง</p>
</section>