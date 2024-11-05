<?php
session_start(); 
include "connect.php";

// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ป้องกัน SQL Injection
    $username = $conn->real_escape_string($username);

    // ค้นหาผู้ใช้ในฐานข้อมูลเฉพาะ username
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // ตรวจสอบรหัสผ่านที่ hash ไว้
        if (password_verify($password, $row['password'])) {
            // รหัสผ่านถูกต้อง
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];

            switch ($_SESSION['role']) {
                case 'admin':
                    header("Location: ../view/admin/dashboard.php");
                    exit(); 
                case 'user':
                    header("Location: ../view/user/dashboard.php");
                    exit();
                case 'staff':
                    header("Location: ../view/staff/dashboard.php");
                    exit();
                default:
                    header("Location: index.php");
                    exit();
            }
        } else {
            $_SESSION['loginfail'] = 'Login ไม่สำเร็จ';
            header("Location: ../../index.php?page=login&error=login_failed");
            exit();
        }
    } else {
        $_SESSION['loginfail'] = 'Login ไม่สำเร็จ';
        header("Location: ../../index.php?page=login&error=login_failed");
        exit();
    }
}

$conn->close(); // ปิดการเชื่อมต่อ
