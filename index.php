<?php
// logout.php
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

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($page == 'about') {
            include "src/view/public/about.php";
        } else if ($page == 'services') {
            include "src/view/public/services.php";
        } else if ($page == 'contact') {
            include "src/view/public/contact.php";
        } else if ($page == 'login') {
            include "src/view/login.php";
        } else if ($page == 'submit_login') {
            include "src/controller/submit_login.php";
        } else if ($page == 'register') {
            include "src/view/register.php";
        } else if ($page == 'submit_register') {
            include "src/controller/submit_register.php";
        } else if ($page == 'logout') {
            include "src/Controller/logout.php";
        } else if ($page == 'admin') {
            header("Location: /careathome/src/view/admin/index.php");
        } else if ($page == 'user') {
            header("Location: /careathome/src/view/user/index.php");
        } else {
            include "src/view/home.php";
        }
    } else {
        include "src/view/home.php";
    }
    include "HeaderFooter/footer.php"
    ?>


</body>

</html>