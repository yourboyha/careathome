<?php
// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // ค้นหาผู้ใช้ในฐานข้อมูลเฉพาะ username
    $result = $conn->query("SELECT * FROM users WHERE username='$username'");

    if ($result->num_rows > 0 && ($row = $result->fetch_assoc()) && password_verify($password, $row['password'])) {

        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];

        // นำไปยังหน้าตาม role ที่กำหนด
        $redirect = ($_SESSION['role'] === 'admin') ? "?page=admin" : "?page=user";
        echo $redirect;
        // "Location: ?page=admin"
        header("Location: $redirect");
    } else {
        $_SESSION['loginfail'] = 'Login ไม่สำเร็จ';
        header("Location: ../../index.php?page=login&error=login_failed");
    }
    exit();
}

$conn->close(); // ปิดการเชื่อมต่อ