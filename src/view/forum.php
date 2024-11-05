


<!-- Content -->
<div class="container mt-5 ">
    <h1 class="text-center ">กระดานสนทนา</h1>
    <p class="lead text-center">ยินดีต้อนรับสู่กระดานสนทนา ที่นี่คุณสามารถพูดคุย แลกเปลี่ยนความคิดเห็น และให้คำแนะนำเกี่ยวกับการดูแลผู้สูงอายุ</p>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card mb-3">
                <div class="card-header">หัวข้อที่ 1: การดูแลผู้สูงอายุในช่วงโควิด-19</div>
                <div class="card-body">
                    <p class="card-text">มีใครมีคำแนะนำหรือวิธีการในการดูแลผู้สูงอายุในช่วงนี้บ้างครับ?</p>
                    <a href="#" class="btn btn-primary">ตอบกลับ</a>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">หัวข้อที่ 2: อาหารที่เหมาะสมสำหรับผู้สูงอายุ</div>
                <div class="card-body">
                    <p class="card-text">อาหารอะไรที่เป็นประโยชน์และเหมาะสมกับผู้สูงอายุบ้าง?</p>
                    <a href="#" class="btn btn-primary">ตอบกลับ</a>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">หัวข้อที่ 3: การออกกำลังกายสำหรับผู้สูงอายุ</div>
                <div class="card-body">
                    <p class="card-text">มีใครแนะนำการออกกำลังกายที่เหมาะสมสำหรับผู้สูงอายุหรือไม่?</p>
                    <a href="#" class="btn btn-primary">ตอบกลับ</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h2>เริ่มหัวข้อใหม่</h2>
            <form action="submit_topic.php" method="POST">
                <div class="mb-3">
                    <label for="topic" class="form-label">หัวข้อ:</label>
                    <input type="text" id="topic" name="topic" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">ข้อความ:</label>
                    <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">สร้างหัวข้อใหม่</button>
            </form>
        </div>
    </div>
</div>