<?php
session_start();
include "../../../controller/connect.php";

// ตรวจสอบว่ามีการส่งรหัสกระทู้
if (!isset($_GET['thread_id'])) {
  header("Location: view_threads.php");
  exit();
}

$thread_id = $_GET['thread_id'];

// ดึงข้อมูลกระทู้
$sql = "SELECT * FROM threads WHERE thread_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $thread_id);
$stmt->execute();
$result = $stmt->get_result();
$thread = $result->fetch_assoc();

// ดึงข้อมูลโพสต์
$sql_posts = "SELECT * FROM posts WHERE thread_id = ?";
$stmt_posts = $conn->prepare($sql_posts);
$stmt_posts->bind_param("i", $thread_id);
$stmt_posts->execute();
$result_posts = $stmt_posts->get_result();
?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($thread['title']); ?></title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">
    <h1><?php echo htmlspecialchars($thread['title']); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($thread['content'])); ?></p>

    <h3>การตอบกระทู้</h3>
    <div class="list-group">
      <?php while ($post = $result_posts->fetch_assoc()): ?>
        <div class="list-group-item">
          <strong><?php echo htmlspecialchars($post['user_id']); ?></strong>
          <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
        </div>
      <?php endwhile; ?>
    </div>

    <?php if (isset($_SESSION['user_id'])): ?>
      <h3>ตอบกระทู้</h3>
      <form method="POST" action="reply_thread.php">
        <input type="hidden" name="thread_id" value="<?php echo $thread_id; ?>">
        <div class="form-group">
          <label for="content">เนื้อหาการตอบ:</label>
          <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">ตอบกระทู้</button>
      </form>
    <?php endif; ?>
  </div>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
</body>

</html>