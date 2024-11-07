<?php

// ตรวจสอบว่า ID ของกระทู้ถูกส่งมาหรือไม่
if (!isset($_GET['id'])) {
  header("Location: /careathome/src/view/user/index.php?page=webboard");
  exit();
}

$thread_id = intval($_GET['id']);

// ดึงข้อมูลกระทู้
$thread_sql = "SELECT * FROM threads WHERE thread_id = $thread_id";
$thread_result = $conn->query($thread_sql);
$thread = $thread_result->fetch_assoc();

// ดึงข้อมูลโพสต์ที่เกี่ยวข้องกับกระทู้
$posts_sql = "SELECT posts.*, Users.username FROM posts 
              JOIN Users ON posts.user_id = Users.user_id 
              WHERE thread_id = $thread_id ORDER BY created_at ASC";
$posts_result = $conn->query($posts_sql);

// จัดการการตอบกระทู้
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post_content'])) {
  $post_content = $conn->real_escape_string($_POST['post_content']);
  $user_id = $_SESSION['user_id']; // สมมุติว่ามี user_id ใน session

  // เพิ่มโพสต์ใหม่ในฐานข้อมูล
  $insert_sql = "INSERT INTO posts (thread_id, user_id, content, created_at) VALUES ('$thread_id', '$user_id', '$post_content', NOW())";
  if ($conn->query($insert_sql) === TRUE) {
    header("Location: index.php?page=view_thread&id=$thread_id"); // รีเฟรชหน้าเพื่อแสดงโพสต์ใหม่
    exit();
  } else {
    echo "เกิดข้อผิดพลาด: " . $conn->error;
  }
}
?>


<div class="container mt-5">
  <h1 class="mb-4 text-center"><?php echo htmlspecialchars($thread['title']); ?></h1>
  <p><?php echo htmlspecialchars($thread['content']); ?></p>
  <p>วันที่สร้าง: <?php echo htmlspecialchars($thread['created_at']); ?></p>

  <h3>โพสต์ในกระทู้นี้</h3>
  <ul class="list-group">
    <?php
    if ($posts_result->num_rows > 0) {
      while ($post = $posts_result->fetch_assoc()) {
        echo "<li class='list-group-item'>";
        echo "<strong>" . htmlspecialchars($post['username']) . ":</strong> ";
        echo htmlspecialchars($post['content']);
        echo "<br><small>วันที่สร้าง: " . htmlspecialchars($post['created_at']) . "</small>";
        echo "</li>";
      }
    } else {
      echo "<li class='list-group-item'>ยังไม่มีโพสต์ในกระทู้นี้</li>";
    }
    ?>
  </ul>

  <!-- ฟอร์มสำหรับตอบกระทู้ -->
  <h3>ตอบกระทู้</h3>
  <?php if (isset($_SESSION['user_id'])): ?>
    <form method="POST" action="">
      <div class="form-group">
        <label for="post_content">เนื้อหาคำตอบ:</label>
        <textarea class="form-control" id="post_content" name="post_content" rows="3" required></textarea>
      </div>
      <div class="text-center mt-2 mb-2">
        <button type="submit" class="btn btn-primary ">ส่งคำตอบ</button>
        <a href="index.php?page=webboard" class="btn btn-secondary">กลับหน้าเว็บบอร์ด</a>
      </div>
    </form>
  <?php else: ?>
    <p>กรุณาเข้าสู่ระบบเพื่อแสดงความคิดเห็น</p>
  <?php endif; ?>

  <?php $conn->close(); ?>