<?php
include 'chkadminid.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ลบข้อมูลจาก patient_info ก่อน
    $sql_delete_patient = "DELETE FROM patient_info WHERE user_id = ?";
    $stmt_delete_patient = $conn->prepare($sql_delete_patient);
    $stmt_delete_patient->bind_param("i", $id);
    $stmt_delete_patient->execute();

    // ลบข้อมูลจาก service_ratings ก่อน
    $sql_delete_ratings = "DELETE FROM service_ratings WHERE user_id = ?";
    $stmt_delete_ratings = $conn->prepare($sql_delete_ratings);
    $stmt_delete_ratings->bind_param("i", $id);
    $stmt_delete_ratings->execute();

    // ลบข้อมูลจาก service_ratings ก่อน
    $sql_delete_posts = "DELETE FROM posts WHERE user_id = ?";
    $stmt_delete_posts = $conn->prepare(query: $sql_delete_posts);
    $stmt_delete_posts->bind_param("i", $id);
    $stmt_delete_posts->execute();

    // ลบข้อมูลจาก user_package ก่อน
    $sql_delete_user_package = "DELETE FROM user_package WHERE user_id = ?";
    $stmt_delete_user_package = $conn->prepare(query: $sql_delete_user_package);
    $stmt_delete_user_package->bind_param("i", $id);
    $stmt_delete_user_package->execute();

    // ลบข้อมูลจาก users หลังจากลบ patient_info
    $sql_delete_user = "DELETE FROM users WHERE user_id = ?";
    $stmt_delete_user = $conn->prepare($sql_delete_user);
    $stmt_delete_user->bind_param("i", $id);
    $stmt_delete_user->execute();

    // เปลี่ยนเส้นทางกลับไปที่หน้า members พร้อมข้อความสำเร็จ
    header("Location:?page=members&success=1");
    exit();
}
