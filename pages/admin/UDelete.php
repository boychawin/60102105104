<?php
//1. เชื่อมต่อ database:
include '../connection.php'; //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
include_once '../functions.php';
$errors = [];
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลักและไม่แก้ไขข้อมูล
if ($_REQUEST['id'] == '') {
    echo "<script type='text/javascript'>";
    echo "alert('เกิดข้อผิดพลาด !!');";
    echo 'window.history.back(1);';
    echo '</script>';
    echo 'เกิดข้อผิดพลาด';
}

//สร้างตัวแปรสำหรับรับค่าที่นำมาแก้ไขจากฟอร์ม
$id = $_REQUEST['id'];
//ทำการปรับปรุงข้อมูลที่จะแก้ไขลงใน database

$sql = "DELETE FROM employee WHERE 1 AND id='$id'";

$result = mysqli_query($db_con, $sql);

mysqli_close($db_con); //ปิดการเชื่อมต่อ database

//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

if ($result) {
    $msg = urlencode('ลบสำเร็จ');
    redirect_user("../admin.php?tab=11&msg=$msg");
} else {
    $errors[] = urlencode('เกิดข้อผิดพลาดกลับไปที่ลองอีกครั้ง !!');
    redirect_user(
        '../admin.php?tab=11&error=' . join($errors, urlencode('<br>'))
    );
}
echo "<script type='text/javascript'>";
echo "alert('เกิดข้อผิดพลาด');";
echo 'window.history.back(1);';
echo '</script>';
