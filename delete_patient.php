<?php
session_start();
include('db.php');

// 1. التحقق من الصلاحية (يجب أن يكون في البداية)
if ($_SESSION['role'] !== 'admin') {
    // إذا لم يكن مديراً، نوقف التنفيذ ونظهر رسالة
    die("<div dir='rtl' style='color:red; text-align:center; margin-top:50px;'>
            <h3>عذراً، لا تملك صلاحية الحذف!</h3>
            <p>هذه الميزة متاحة فقط للمدير (Admin).</p>
            <a href='patients.php' class='btn btn-primary'>العودة لقائمة المرضى</a>
         </div>");
}

// 2. كود الحذف الفعلي (لا يصل السيرفر هنا إلا إذا كان الشخص مديراً)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM patients WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header("location: patients.php");
        exit();
    } else {
        echo "خطأ في الحذف: " . mysqli_error($conn);
    }
}
?>