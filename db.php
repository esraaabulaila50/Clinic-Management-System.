<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "clinic_db";

// إنشاء الاتصال
$conn = mysqli_connect($host, $user, $pass, $dbname);

// التحقق من الاتصال
if (!$conn) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

// ضبط الترميز ليدعم اللغة العربية
mysqli_set_charset($conn, "utf8");
?>