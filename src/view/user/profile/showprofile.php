<!-- แบบฟอร์มบันทึกข้อมูลส่วนตัว -->
<div id="personalInfo" class="mb-4">
  <h3>บันทึกข้อมูลส่วนตัว</h3>
  <form action="submit_personal_info.php" method="POST">
    <div class="mb-3">
      <label for="fullname" class="form-label">ชื่อ-นามสกุล</label>
      <input type="text" id="fullname" name="fullname" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="address" class="form-label">ที่อยู่</label>
      <input type="text" id="address" name="address" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="telephone" class="form-label">เบอร์โทรศัพท์</label>
      <input type="text" id="telephone" name="telephone" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">บันทึกข้อมูลส่วนตัว</button>
  </form>
</div>