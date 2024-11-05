<?php
session_start();

include "connect.php";
// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    // ตรวจสอบว่าชื่อผู้ใช้มีอยู่แล้วในฐานข้อมูลหรือไม่
    $checkUser = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($checkUser);

    if ($result->num_rows > 0) {
        echo "Username already taken!";
    } else {
        // เข้ารหัสรหัสผ่านก่อนบันทึกลงในฐานข้อมูล
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // เพิ่มผู้ใช้ใหม่ลงในฐานข้อมูล
        $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email','$hashedPassword','user')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful! You can now log in.";
            header("Location: ../../index.php?page=login");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close(); // ปิดการเชื่อมต่อ
?>
