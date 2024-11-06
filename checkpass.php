<?php

$hash = '$2y$10$5c4qzIUlQk9sSyHkVfx6vOlQZC/h6Hdsz0lMXnAcfxqmqBC7G0TOG';
$input_password = 123456; // ใส่รหัสที่ต้องการตรวจสอบ

if (password_verify($input_password, $hash)) {
  echo "Password is correct!";
} else {
  echo "Password is incorrect!";
}

echo password_hash('123456', PASSWORD_DEFAULT);
