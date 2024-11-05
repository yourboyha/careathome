<div class="container mt-5">
    <h1 class="text-center">ลงทะเบียน</h1>
    <!-- <form action="Controller/submit_register.php" method="POST"> -->
    <form action="src/controller/submit_register.php" method="POST">

        <div class="mb-3">
            <label for="username" class="form-label">ชื่อผู้ใช้:</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">อีเมล:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">รหัสผ่าน:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">ยืนยันรหัสผ่าน:</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">ลงทะเบียน</button>
    </form>
</div>