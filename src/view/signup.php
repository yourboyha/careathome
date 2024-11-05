<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>สมัครสมาชิก</h1>
    </header>

    <nav>
        <a href="index.html">หน้าหลัก</a>
        <a href="#about">เกี่ยวกับเรา</a>
        <a href="#services">บริการของเรา</a>
        <a href="signup.html">สมัครสมาชิก</a>
        <a href="#contact">ติดต่อเรา</a>
    </nav>

    <div class="content">
        <section id="signup">
            <h2>ลงทะเบียนเพื่อรับคำปรึกษา</h2>
            <form action="#" method="post">
                <label for="name">ชื่อ:</label><br>
                <input type="text" id="name" name="name" required><br><br>

                <label for="email">อีเมล:</label><br>
                <input type="email" id="email" name="email" required><br><br>

                <label for="password">รหัสผ่าน:</label><br>
                <input type="password" id="password" name="password" required><br><br>

                <label for="confirm_password">ยืนยันรหัสผ่าน:</label><br>
                <input type="password" id="confirm_password" name="confirm_password" required><br><br>

                <input type="submit" value="สมัครสมาชิก">
            </form>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 เว็บไซต์ให้คำปรึกษาด้านการดูแลผู้สูงอายุ. สงวนลิขสิทธิ์</p>
    </footer>
</body>

</html>
