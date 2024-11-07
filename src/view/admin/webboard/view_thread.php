<?php

include 'chkadmin.php';

$thread_id = intval($_GET['id']);

// ดึงข้อมูลกระทู้
$thread_sql = "SELECT * FROM threads WHERE thread_id = $thread_id";
$thread_result = $conn->query($thread_sql);
$thread = $thread_result->fetch_assoc();

// ดึงข้อมูลโพสต์ที่เกี่ยวข้องกับกระทู้
$posts_sql = "SELECT * FROM posts WHERE thread_id = $thread_id ORDER BY created_at ASC";
$posts_result = $conn->query($posts_sql);

// จัดการการตอบกระทู้
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post_content'])) {
  $post_content = $conn->real_escape_string($_POST['post_content']);
  $user_id = $_SESSION['user_id']; // สมมุติว่ามี user_id ใน session

  // เพิ่มโพสต์ใหม่ในฐานข้อมูล
  $insert_sql = "INSERT INTO posts (thread_id, user_id, content, created_at) VALUES ('$thread_id', '$user_id', '$post_content', NOW())";
  if ($conn->query($insert_sql) === TRUE) {
    header("Location: ?page=view_thread&id=$thread_id"); // รีเฟรชหน้าเพื่อแสดงโพสต์ใหม่
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

  <h3 class="mt-4">โพสต์ในกระทู้นี้</h3>
  <ul class="list-group">
    <?php
    if ($posts_result->num_rows > 0) {
      while ($post = $posts_result->fetch_assoc()) {
        echo "<li class='list-group-item'>";
        echo "<strong>ผู้ใช้ ID " . htmlspecialchars($post['user_id']) . ":</strong> ";
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
  <h3 class="mt-4">ตอบกระทู้</h3>
  <form method="POST" action="" class="mb-3">
    <div class="form-group">
      <label for="post_content">เนื้อหาคำตอบ:</label>
      <textarea class="form-control" id="post_content" name="post_content" rows="3" required></textarea>
    </div>
    <div class="text-center mb3 mt-3">
      <button type="submit" class="btn btn-primary ">ส่งคำตอบ</button>
      <a href="?page=webboard" class="btn btn-secondary ">กลับไปยังหน้าจัดการกระทู้</a>
    </div>
  </form>



</div>