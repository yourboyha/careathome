<?php
session_start();
include "../../../controller/connect.php";

if ($_SESSION['role'] !== 'admin') {
    header("Location: /careathome/index.php?page=login");
    exit();
}

// ฟังก์ชันค้นหาข้อมูลผู้ใช้
$searchTerm = '';
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search_term'];
}

// ดึงข้อมูลผู้ใช้งานจากฐานข้อมูล
$sql = "SELECT * FROM users WHERE 
    username LIKE '%$searchTerm%' OR 
    fullname LIKE '%$searchTerm%' OR 
    email LIKE '%$searchTerm%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผู้ดูแลระบบ</title>
    <link rel="stylesheet" href="../../../../css/styles.css">
    <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
</head>

<body>
    <?php
    include "../../../../HeaderFooter/header.php";
    ?>

<div class="container mt-5">
        <h1 class="mb-4 text-center">จัดการผู้ใช้งาน</h1>

        <!-- ฟอร์มค้นหาข้อมูล -->
        <form class="mb-4" method="POST" action="">
            <div class="input-group">
                <input type="text" class="form-control" name="search_term" placeholder="ค้นหาชื่อผู้ใช้งาน, อีเมล หรือบทบาท" value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button class="btn btn-primary" type="submit" name="search">ค้นหา</button>
            </div>
        </form>

        <!-- ปุ่มเพิ่มสมาชิก -->
        <a href="add_member.php" class="btn btn-success mb-3">เพิ่มสมาชิกใหม่</a>

        <!-- แสดงตารางข้อมูลผู้ใช้ -->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark text-center">
                <tr>
                    <th>รหัสผู้ใช้งาน</th>
                    <th>ชื่อผู้ใช้งาน</th>
                    <th>อีเมล</th>
                    <th>บทบาท</th>
                    <th colspan="2">จัดการข้อมูลผู้ใช้งาน</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                        echo "<td class='text-center'><a href='edit_member.php?id=" . $row['user_id'] . "' class='btn btn-warning'>แก้ไข</a></td>";
                        echo "<td class='text-center'><a href='delete_member.php?id=" . $row['user_id'] . "' class='btn btn-danger' onclick='return confirm(\"คุณแน่ใจว่าต้องการลบสมาชิกนี้?\");'>ลบ</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>ไม่มีข้อมูลผู้ใช้</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>




    <?php
    include "../../../../HeaderFooter/footer.php"
    ?>

    <script src="../../../../js/bootstrap.bundle.min.js"></script>
    <script src="../../../../js/script.js"></script>


</body>

</html>

<?php $conn->close(); ?>