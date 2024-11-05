<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4ff;
        }
        .price-card {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 30px;
            text-align: center;
        }
        .price-title {
            font-size: 2.5rem;
            color: #4170ff;
            font-weight: bold;
        }
        .btn-toggle {
            background-color: #eff3ff;
            border-radius: 30px;
            padding: 10px 20px;
            margin: 10px 0;
        }
        .btn-toggle .active {
            background-color: #4170ff;
            color: white;
        }
        .profile-card {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            background-color: #eff3ff;
            padding: 20px;
            text-align: center;
        }
        .profile-card img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
        }
        .skills {
            margin-top: 20px;
        }
        .skills span {
            background-color: white;
            border-radius: 20px;
            padding: 5px 10px;
            margin: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <!-- Price Section -->
        <div class="col-md-6">
            <div class="price-card">
                <h4>อาการคนไข้เป็นแบบไหนคะ ?</h4>
                <button class="btn btn-primary mb-4">พักรักษาตัวที่รพ.</button>
                <div class="price-title">19,900</div>
                <p>บาท/เดือน</p>
                <div class="btn-toggle">
                    <button class="btn btn-light me-2">รายวัน</button>
                    <button class="btn active">รายเดือน</button>
                </div>
                <p>บริการเฝ้าไข้ที่รพ. สำหรับคนไข้ทุกอาการ</p>
            </div>
        </div>
        <!-- Profile Section -->
        <div class="col-md-6">
            <div class="profile-card">
                <h5>แคร์โปร ฟ้า (52 ปี, ประสบการณ์ 2 ปี)</h5>
                <img src="https://via.placeholder.com/120" alt="Caregiver">
                <div class="skills">
                    <span>หลังผ่าตัด</span>
                    <span>มะเร็ง</span>
                    <span>เบาหวาน</span>
                    <span>ความดันโลหิตสูง</span>
                    <span>โรคไต</span>
                    <span>หลอดเลือดสมอง</span>
                    <span>ปอดอักเสบ</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
