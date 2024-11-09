<div class="container mt-5">
    <h1 class="text-center">ลงทะเบียน</h1>
    <form action="src/controller/submit_register.php" method="POST" onsubmit="return validatePasswords()">

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
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">ลงทะเบียน</button>
        </div>
    </form>
</div>

<?php if (!empty($_SESSION['error']) || !empty($_SESSION['success'])): ?>
    <script>
        alert("<?= $_SESSION['error'] ?? $_SESSION['success'] ?>");
        <?php unset($_SESSION['error'], $_SESSION['success']); ?>
    </script>
<?php endif; ?>

<script>
    function validatePasswords() {
        if (document.getElementById("password").value !== document.getElementById("confirm_password").value) {
            alert("รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน กรุณาลองใหม่");
            return false;
        }
        return true;
    }
</script>