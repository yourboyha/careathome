<?php

if ($_SESSION['role'] !== 'admin') {
  header("Location: /careathome/index.php?page=login");
  exit();
}
