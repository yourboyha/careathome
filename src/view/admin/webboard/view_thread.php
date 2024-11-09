<?php
include 'chkadmin.php';

$thread_id = intval($_GET['id']);
$thread_result = $conn->query("SELECT * FROM threads WHERE thread_id = $thread_id");
$thread = $thread_result->fetch_assoc();

$posts_result = $conn->query("SELECT * FROM posts WHERE thread_id = $thread_id ORDER BY created_at ASC");

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['post_content'])) {
  $post_content = $conn->real_escape_string($_POST['post_content']);
  $user_id = $_SESSION['user_id'];
  if ($conn->query("INSERT INTO posts (thread_id, user_id, content, created_at) VALUES ('$thread_id', '$user_id', '$post_content', NOW())") === TRUE) {
    header("Location: ?page=view_thread&id=$thread_id");
    exit();
  } else {
    echo "เกิดข้อผิดพลาด: " . $conn->error;
  }
}
?>

<div class="container mt-5">
  <h1 class="mb-4 text-center"><?= htmlspecialchars($thread['title']); ?></h1>
  <p><?= htmlspecialchars($thread['content']); ?></p>
  <p>วันที่สร้าง: <?= htmlspecialchars($thread['created_at']); ?></p>

  <h3 class="mt-4">โพสต์ในกระทู้นี้</h3>
  <ul class="list-group">
    <?php if ($posts_result->num_rows > 0): ?>
      <?php while ($post = $posts_result->fetch_assoc()): ?>
        <li class='list-group-item'>
          <strong>ผู้ใช้ ID <?= htmlspecialchars($post['user_id']); ?>:</strong> <?= htmlspecialchars($post['content']); ?>
          <br><small>วันที่สร้าง: <?= htmlspecialchars($post['created_at']); ?></small>
        </li>
      <?php endwhile; ?>
    <?php else: ?>
      <li class='list-group-item'>ยังไม่มีโพสต์ในกระทู้นี้</li>
    <?php endif; ?>
  </ul>

  <h3 class="mt-4">ตอบกระทู้</h3>
  <form method="POST" class="mb-3">
    <div class="form-group">
      <label for="post_content">เนื้อหาคำตอบ:</label>
      <textarea class="form-control" id="post_content" name="post_content" rows="3" required></textarea>
    </div>
    <div class="text-center mb-3 mt-3">
      <button type="submit" class="btn btn-primary">ส่งคำตอบ</button>
      <a href="?page=webboard" class="btn btn-secondary">กลับไปยังหน้าจัดการกระทู้</a>
    </div>
  </form>
</div>