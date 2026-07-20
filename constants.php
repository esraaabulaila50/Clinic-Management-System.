<?php 
// بدء الجلسة
session_start();

// تعريف الثوابت للاتصال بقاعدة البيانات
define('SITEURL', 'http://localhost/clinic_management/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'clinic_db');

// الاتصال بقاعدة البيانات
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
$db_select = mysqli_select_with_db($conn, DB_NAME) or die(mysqli_error($conn));
mysqli_set_charset($conn, "utf8");

// دالة مساعدة للتحقق من تسجيل الدخول
function check_login() {
    if(!isset($_SESSION['user_id'])) {
        $_SESSION['no-login-message'] = "<div class='alert alert-danger text-center'>يرجى تسجيل الدخول للوصول إلى لوحة التحكم</div>";
        header('location:'.SITEURL.'login.php');
    }
}
?>
