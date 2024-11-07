<?php
include "chkss.php";

$user_id = $_SESSION['user_id'];
$rating = "";
$feedback = "";

// จัดการการส่งข้อมูลเมื่อผู้ใช้ให้คะแนนและความคิดเห็น
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $rating = intval($_POST['rating']);
  $feedback = $conn->real_escape_string($_POST['feedback']);

  // เพิ่มข้อมูลการให้คะแนนในฐานข้อมูล
  $sql = "INSERT INTO service_ratings (user_id, rating, feedback, created_at) VALUES ('$user_id', '$rating', '$feedback', NOW())";
  if ($conn->query($sql) === TRUE) {
    echo "<p class='alert alert-success'>ส่งคะแนนเรียบร้อยแล้ว ขอบคุณสำหรับความคิดเห็นของคุณ!</p>";
  } else {
    echo "<p class='alert alert-danger'>เกิดข้อผิดพลาด: " . $conn->error . "</p>";
  }
}

// ดึงข้อมูลรีวิวทั้งหมดของผู้ใช้จากฐานข้อมูล
$sql_reviews = "SELECT rating, feedback, created_at FROM service_ratings WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result_reviews = $conn->query($sql_reviews);
?>

?>
<div class="container mt-5">
  <section class="rating">
    <h2>ให้คะแนนบริการของเรา</h2>
    <form method="POST" action="">
      <div class="form-group">
        <label for="rating">ให้คะแนน (1-5 ดาว):</label>
        <select class="form-control text-center" id="rating" name="rating" required>
          <option value="">เลือกคะแนน</option>
          <option value="1">1 ดาว</option>
          <option value="2">2 ดาว</option>
          <option value="3">3 ดาว</option>
          <option value="4">4 ดาว</option>
          <option value="5">5 ดาว</option>
        </select>
      </div>

      <div class="form-group mt-3">
        <label for="feedback">ความคิดเห็น:</label>
        <textarea class="form-control" id="feedback" name="feedback" rows="4" required></textarea>
      </div>

      <button type="submit" class="btn btn-primary mt-3">ส่งคะแนน</button>
    </form>
  </section>
  <section class="reviews mt-5">
    <h3>ประวัติการรีวิวของคุณ</h3>
    <?php
    if ($result_reviews->num_rows > 0) {
      // แสดงประวัติการรีวิว
      while ($row = $result_reviews->fetch_assoc()) {
        $rating_stars = str_repeat("\u{2B50}", $row['rating']);
        echo "<div class='review'>
                <p><strong>คะแนน:</strong> $rating_stars</p>
                <p><strong>ความคิดเห็น:</strong> {$row['feedback']}</p>
                <p><small>วันที่รีวิว: " . date('d-m-Y H:i', strtotime($row['created_at'])) . "</small></p>
              </div><hr>";
      }
    } else {
      echo "<p>คุณยังไม่ได้ให้คะแนนบริการใดๆ</p>";
    }
    ?>
  </section>
</div>

<?php $conn->close(); ?>