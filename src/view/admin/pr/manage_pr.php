<?php
session_start();
include "../../../controller/connect.php";

if ($_SESSION['role'] !== 'admin') {
    header("Location: /careathome/index.php?page=login");
    exit();
}

// ฟังก์ชันค้นหาข้อมูลข่าวประชาสัมพันธ์
$searchTerm = '';
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search_term'];
}

// ดึงข้อมูลข่าวประชาสัมพันธ์จากฐานข้อมูล
$sql = "SELECT * FROM pr WHERE 
    title LIKE '%$searchTerm%' OR 
    details LIKE '%$searchTerm%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผู้ดูแลระบบ - ข่าวประชาสัมพันธ์</title>
    <link rel="stylesheet" href="../../../../css/styles.css">
    <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
</head>

<body>
    <?php
    include "../../../../HeaderFooter/header.php";
    ?>

    <div class="container mt-5">
        <h1 class="mb-4 text-center">จัดการข่าวประชาสัมพันธ์</h1>

        <!-- ฟอร์มค้นหาข้อมูล -->
        <form class="mb-4" method="POST" action="">
            <div class="input-group">
                <input type="text" class="form-control" name="search_term" placeholder="ค้นหาชื่อข่าวหรือรายละเอียด" value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button class="btn btn-primary" type="submit" name="search">ค้นหา</button>
            </div>
        </form>

        <!-- ปุ่มเพิ่มข่าวประชาสัมพันธ์ -->
        <a href="add_pr.php" class="btn btn-success mb-3">เพิ่มข่าวประชาสัมพันธ์ใหม่</a>

        <!-- แสดงตารางข่าวประชาสัมพันธ์ -->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark text-center">
                <tr>
                    <th>รหัสข่าวประชาสัมพันธ์</th>
                    <th>ชื่อข่าว</th>
                    <th>วันที่</th>
                    <th>รายละเอียด</th>
                    <th colspan="2">จัดการข่าวประชาสัมพันธ์</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['details']) . "</td>";
                        echo "<td class='text-center'><a href='edit_pr.php?id=" . $row['id'] . "' class='btn btn-warning'>แก้ไข</a></td>";
                        echo "<td class='text-center'><a href='delete_pr.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"คุณแน่ใจว่าต้องการลบข่าวนี้?\");'>ลบ</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>ไม่มีข้อมูลข่าวประชาสัมพันธ์</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    include "../../../../HeaderFooter/footer.php";
    ?>

    <script src="../../../../js/bootstrap.bundle.min.js"></script>
    <script src="../../../../js/script.js"></script>

</body>

</html>

<?php $conn->close(); ?>
