<?php
// ชื่อไฟล์ที่เก็บจำนวนผู้เข้าชม
$file = "../counter.txt";

// อ่านค่าจำนวนผู้เข้าชมปัจจุบันจากไฟล์
$current_count = file_get_contents($file);

// แปลงค่าจาก string เป็น integer
$current_count = intval($current_count);

// เพิ่มจำนวนผู้เข้าชม
$current_count++;

// เขียนจำนวนผู้เข้าชมใหม่ลงในไฟล์
file_put_contents($file, $current_count);

 
echo $current_count; 
