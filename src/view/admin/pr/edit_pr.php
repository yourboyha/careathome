<?php
include 'chkadminid.php';
// รับ ID ของข่าวประชาสัมพันธ์
$id = $_GET['id'];

// เริ่มต้นค่าตัวแปร
$title = $details = '';

// ดึงข้อมูลข่าวประชาสัมพันธ์จากฐานข้อมูล
$sql = "SELECT * FROM pr WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $details = $row['details'];
} else {
    echo "<script>alert('ไม่พบข่าวประชาสัมพันธ์ที่ต้องการแก้ไข'); window.location.href='?page=pr';</script>";
    exit();
}

// อัพเดตข้อมูลข่าวประชาสัมพันธ์
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $details = $_POST['details'];

    $sql = "UPDATE pr SET title = ?, details = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $details, $id);

    if ($stmt->execute()) {
        echo "<script>alert('อัพเดตข่าวประชาสัมพันธ์เรียบร้อย!'); window.location.href='?page=pr';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการอัพเดตข่าวประชาสัมพันธ์: " . $conn->error . "');</script>";
    }

    $stmt->close();
}

?>

<div class="container mt-5">
    <h1 class="text-center">แก้ไขข่าวประชาสัมพันธ์</h1>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="title" class="form-label">หัวข้อข่าวประชาสัมพันธ์</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>"
                required>
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">รายละเอียดข่าวประชาสัมพันธ์</label>
            <textarea class="form-control" id="details" name="details" rows="5"
                required><?php echo htmlspecialchars($details); ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">อัพเดตข่าวประชาสัมพันธ์</button>
        <a href="?page=pr" class="btn btn-secondary">กลับไปจัดการข่าวประชาสัมพันธ์</a>
    </form>
</div>