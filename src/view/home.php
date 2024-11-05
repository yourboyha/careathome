<!-- แบนเนอร์ -->
<section class="banner">
    <h1>การดูแลที่อบอุ่น เริ่มต้นที่นี่</h1>
</section>


<?php
$sql = "SELECT * FROM pr ORDER BY date DESC"; // ดึงข้อมูลทั้งหมดเรียงตามวันที่ล่าสุด
$result = $conn->query($sql);
?>
<!-- ส่วนให้ความรู้ประชาสัมพันธ์ -->
<section class="knowledge">
    <h2>ประชาสัมพันธ์บริการ</h2>
    <div class="container">
        <div class="row">
            <?php
            // ดึงข้อมูลข่าวประชาสัมพันธ์ทั้งหมด
            $sql = "SELECT * FROM pr ORDER BY date DESC"; // ดึงข่าวทั้งหมดโดยเรียงลำดับจากวันที่ใหม่ไปเก่า
            $result = $conn->query($sql);

            // ตรวจสอบว่ามีข่าวประชาสัมพันธ์หรือไม่
            if ($result->num_rows > 0) {
                // แสดงข่าวประชาสัมพันธ์
                $counter = 0; // นับจำนวนข่าวที่แสดง
                while ($row = $result->fetch_assoc()) {
                    // ทุกข่าวที่สองให้เริ่มแถวใหม่
                    if ($counter % 2 == 0 && $counter > 0) {
                        echo "</div><div class='row'>"; // ปิดแถวเก่าและเริ่มแถวใหม่
                    }
                    echo "<div class='col-md-6 mb-4'>"; // ใช้ Bootstrap เพื่อให้แสดงใน 2 คอลัมน์
                    echo "<article class='border p-3'>"; // เพิ่มขอบและ padding
                    echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                    echo "<p>" . htmlspecialchars($row['details']) . "</p>";
                    echo "</article>";
                    echo "</div>";
                    $counter++; // เพิ่มตัวนับ
                }
            } else {
                echo "<p>ยังไม่มีข่าวประชาสัมพันธ์</p>";
            }
            ?>
        </div>
    </div>
</section>






<!-- ส่วนสถิติผู้เข้าชม -->
<section class="statistics">
    <h2>สถิติผู้เข้าชม</h2>
    <p>มีผู้เข้าชมแล้ว: <?php
                        include("counter.php");
                        ?> ครั้ง</p>
</section>

<!-- ส่วนให้คะแนนบริการ -->
<?php

// ดึงข้อมูลรีวิวจากตาราง service_ratings พร้อมข้อมูลผู้รีวิว
$sql = "
    SELECT 
        u.fullname AS reviewer_name,  -- ชื่อผู้รีวิวจากตาราง users
        r.rating,
        r.feedback
    FROM 
        service_ratings AS r
    JOIN 
        users AS u ON r.user_id = u.user_id
    ORDER BY 
        r.created_at DESC;
";
$result = $conn->query($sql);
?>
<div class="container mt-5">
    <h2 class="text-center mb-4">รีวิวและความคิดเห็น</h2>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            // แสดงข้อมูลรีวิวในรูปแบบการ์ด
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '    <div class="card h-100">';
                echo '        <div class="card-body">';
                echo '            <h5 class="card-title">' . htmlspecialchars($row['reviewer_name']) . '</h5>';
                echo '            <h6 class="card-subtitle mb-2 text-muted">Rating: ' . htmlspecialchars($row['rating']) . ' ดาว</h6>';
                echo '            <p class="card-text">' . htmlspecialchars($row['feedback']) . '</p>';
                echo '        </div>';
                echo '    </div>';
                echo '</div>';
            }
        } else {
            echo '<p class="text-center">ยังไม่มีรีวิวในขณะนี้</p>';
        }
        ?>
    </div>
</div>