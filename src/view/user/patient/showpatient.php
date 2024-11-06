 <!-- แบบฟอร์มบันทึกข้อมูลคนไข้ -->
 <div id="patientInfo" class="mb-4">
   <h3>บันทึกข้อมูลคนไข้</h3>
   <form action="submit_patient_info.php" method="POST">
     <div class="mb-3">
       <label for="patient_name" class="form-label">ชื่อคนไข้</label>
       <input type="text" id="patient_name" name="patient_name" class="form-control" required>
     </div>
     <div class="mb-3">
       <label for="patient_condition" class="form-label">อาการของคนไข้</label>
       <textarea id="patient_condition" name="patient_condition" class="form-control" rows="3" required></textarea>
     </div>
     <button type="submit" class="btn btn-primary">บันทึกข้อมูลคนไข้</button>
   </form>
 </div>