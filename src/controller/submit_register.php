<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // ตรวจสอบว่าชื่อผู้ใช้มีอยู่แล้วในฐานข้อมูลหรือไม่
    $checkUser = "SELECT 1 FROM users WHERE username='$username'";
    $result = $conn->query($checkUser);

    // ตรวจสอบผลลัพธ์ก่อนใช้งาน
    if ($result && $result->num_rows > 0) {
        $_SESSION['error'] = "ชื่อผู้ใช้นี้มีอยู่ในระบบแล้ว กรุณาเลือกชื่อผู้ใช้ใหม่";
        header("Location: /careathome/index.php?page=register");
    } else {
        // เพิ่มผู้ใช้ใหม่ในฐานข้อมูล
        $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', 'user')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['success'] = "ลงทะเบียนสำเร็จ! กรุณาเข้าสู่ระบบ";
            header("Location: ../../index.php?page=login");
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลาดในการลงทะเบียน กรุณาลองใหม่อีกครั้ง";
            header("Location: /careathome/index.php?page=register");
        }
    }
    exit();
}

$conn->close();
