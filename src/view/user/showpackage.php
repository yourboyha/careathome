    <!-- เลือกแพคเกจ -->
    <div id="selectPackage" class="mb-4">
      <h3>เลือกแพคเกจ</h3>
      <form action="submit_package_selection.php" method="POST">
        <div class="mb-3">
          <label for="package" class="form-label">แพคเกจที่ต้องการ</label>
          <select id="package" name="package" class="form-control" required>
            <option value="basic">แพคเกจพื้นฐาน</option>
            <option value="premium">แพคเกจพรีเมียม</option>
            <option value="vip">แพคเกจ VIP</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">เลือกแพคเกจ</button>
      </form>
    </div>