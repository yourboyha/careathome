<?php
session_start();

include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ตรวจสอบว่าชื่อผู้ใช้มีอยู่แล้วในฐานข้อมูลหรือไม่
    $checkUser = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($checkUser);

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "ชื่อผู้ใช้นี้มีอยู่ในระบบแล้ว กรุณาเลือกชื่อผู้ใช้ใหม่";
        header("Location: /careathome/index.php?page=register");
        exit();
    } else {
        // เข้ารหัสรหัสผ่านก่อนบันทึกลงในฐานข้อมูล
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // เพิ่มผู้ใช้ใหม่ลงในฐานข้อมูล
        $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email','$hashedPassword','user')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['success'] = "ลงทะเบียนสำเร็จ! กรุณาเข้าสู่ระบบ";
            header("Location: ../../index.php?page=login");
            exit();
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลาดในการลงทะเบียน กรุณาลองใหม่อีกครั้ง";
            header("Location: /careathome/index.php?page=register");
            exit();
        }
    }
}

$conn->close();
