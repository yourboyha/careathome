<?php
session_start();
include "src/controller/connect.php";
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บริการดูแลผู้สูงอายุ</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <?php
    include "HeaderFooter/header.php";

    // หน้าในเว็บที่สามารถเลือกได้
    $pages = [
        'about' => 'src/view/public/about.php',
        'services' => 'src/view/public/services.php',
        'contact' => 'src/view/public/contact.php',
        'login' => 'src/view/login.php',
        'submit_login' => 'src/controller/submit_login.php',
        'register' => 'src/view/register.php',
        'submit_register' => 'src/controller/submit_register.php',
        'logout' => 'src/Controller/logout.php',
        'admin' => '/careathome/src/view/admin/index.php',  // รีไดเรกต์ไปยังหน้าแอดมิน
        'user' => '/careathome/src/view/user/index.php'     // รีไดเรกต์ไปยังหน้าใช้งาน
    ];

    // ตรวจสอบว่า 'page' ได้รับค่าหรือไม่ และแสดงหน้าที่เลือก
    $page = $_GET['page'] ?? 'home';  // หากไม่มีค่า 'page' ให้ใช้ 'home' เป็นค่าเริ่มต้น

    if (array_key_exists($page, $pages)) {
        if (strpos($pages[$page], '/') === 0) {
            header("Location: " . $pages[$page]);  // ใช้ header เมื่อเป็นลิงก์ภายนอก
        } else {
            include $pages[$page];  // ใช้ include เมื่อเป็นไฟล์ภายใน
        }
    } else {
        include "src/view/home.php";  // หากไม่มีหน้าตรงกับที่เลือก ให้แสดงหน้า home
    }

    include "HeaderFooter/footer.php";
    ?>

</body>

</html>