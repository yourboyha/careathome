<?php
if ($_SESSION['role'] !== 'admin' || !isset($_GET['id'])) {
  header("Location: /careathome/index.php?page=login");
  exit();
}
