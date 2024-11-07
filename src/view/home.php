<?php
// ดึงข้อมูลแพ็คเกจทั้งหมด
$sql_all_packages = "SELECT * FROM packages";
$result_all_packages = $conn->query($sql_all_packages);
?>

<!-- แบนเนอร์ -->
<section class="banner">
    <h1>การดูแลที่อบอุ่น เริ่มต้นที่นี่</h1>
</section>

<!-- ส่วนให้ความรู้ประชาสัมพันธ์ -->
<h2 class="text-center mt-3 mb-3">ประชาสัมพันธ์บริการ</h2>
<div class="container">
    <div class="row">
        <?php
        // ดึงข้อมูลข่าวประชาสัมพันธ์ทั้งหมดเรียงตามวันที่ใหม่ไปเก่า
        $sql = "SELECT * FROM pr ORDER BY date DESC";
        $result = $conn->query($sql);

        // ตรวจสอบว่ามีข่าวประชาสัมพันธ์หรือไม่
        if ($result->num_rows > 0) {
            $counter = 0; // นับจำนวนข่าวที่แสดง
            while ($row = $result->fetch_assoc()) {
                if ($counter % 2 == 0 && $counter > 0) {
                    echo "</div><div class='row'>";
                }
                echo "<div class='col-md-6 mb-2'>
                            <article class='border p-2'>
                                <h3>" . htmlspecialchars($row['title']) . "</h3>
                                <p>" . htmlspecialchars($row['details']) . "</p>
                            </article>
                          </div>";
                $counter++;
            }
        } else {
            echo "<p>ยังไม่มีข่าวประชาสัมพันธ์</p>";
        }
        ?>
    </div>
</div>


<!-- ส่วนแพคเกจที่ให้บริการ -->

<div class="container">
    <h2>แพคเกจที่ให้บริการ</h2>
    <div class="row">
        <?php
        if ($result_all_packages->num_rows > 0) {
            while ($row = $result_all_packages->fetch_assoc()) {
                echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                                <div class='card-body'>
                                    <h5 class='card-title'>" . htmlspecialchars($row['package_name']) . "</h5>
                                    <p class='card-text'>" . htmlspecialchars($row['package_description']) . "</p>
                                    <p><strong>ราคา: </strong>" . htmlspecialchars($row['cost']) . " บาท</p>
                                    <form method='POST' action='select_package.php'>
                                        <input type='hidden' name='package_id' value='" . $row['package_id'] . "'>
                                        <button type='submit' class='btn btn-success'>เลือกแพ็คเกจ</button>
                                    </form>
                                </div>
                            </div>
                          </div>";
            }
        }
        ?>
    </div>
</div>


<!-- ส่วนให้คะแนนบริการ -->
<?php
// ดึงข้อมูลรีวิวจากตาราง service_ratings พร้อมข้อมูลผู้รีวิว
$sql = "SELECT u.fullname AS reviewer_name, r.rating, r.feedback
        FROM service_ratings AS r
        JOIN users AS u ON r.user_id = u.user_id
        ORDER BY r.created_at DESC";
$result = $conn->query($sql);
?>

<div class="container">
    <h2 class="text-center">รีวิวและความคิดเห็น</h2>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4 mb-2'>
                            <div class='card h-100'>
                                <div class='card-body'>
                                    <h5 class='card-title'>" . htmlspecialchars($row['reviewer_name']) . "</h5>
                                    <h6 class='card-subtitle mb-2 text-muted'>Rating: " . htmlspecialchars($row['rating']) . " ดาว</h6>
                                    <p class='card-text'>" . htmlspecialchars($row['feedback']) . "</p>
                                </div>
                            </div>
                          </div>";
            }
        } else {
            echo "<p class='text-center'>ยังไม่มีรีวิวในขณะนี้</p>";
        }
        ?>
    </div>
</div>

<!-- ส่วนสถิติผู้เข้าชม -->
<section class="text-center mt-3 mb-3">
    <h2>สถิติผู้เข้าชม</h2>
    <p>มีผู้เข้าชมแล้ว: <?php include("counter.php"); ?> ครั้ง</p>
</section>