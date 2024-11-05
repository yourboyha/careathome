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
            include "src/view/about.php";
        } else if ($page == 'services') {
            include "src/view/services.php";
        } else if ($page == 'contact') {
            include "src/view/contact.php";
        } else if ($page == 'forum') {
            include "src/view/forum.php";
        } else if ($page == 'login') {
            include "src/view/login.php";
        } else if ($page == 'register') {
            include "src/view/register.php";
        } else if ($page == 'edit_profile') {
            include "src/view/edit_profile.php";
        } else if ($page == 'logout') {
            include "src/Controller/logout.php";
        } else {
            include "src/view/home.php";
        }
    } else {
        include "src/view/home.php";
    }
    include "HeaderFooter/footer.php"
    ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>


</body>

</html>