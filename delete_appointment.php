<?php
session_start();
include('db.php');

// التحقق من الصلاحية: يجب أن يكون مديراً (Admin) للحذف
if ($_SESSION['role'] !== 'admin') {
    die("<div dir='rtl' style='color:red; text-align:center; margin-top:50px; font-family:sans-serif;'>
            <h3>عذراً، لا تملك صلاحية الحذف!</h3>
            <p>هذه الميزة متاحة فقط للمدير (Admin).</p>
            <a href='appointments.php' style='display:inline-block; padding:10px 20px; background:#007bff; color:white; text-decoration:none; border-radius:5px;'>العودة لجدول المواعيد</a>
         </div>");
}

// تنفيذ الحذف إذا كان مديراً
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM appointments WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header("location: appointments.php");
        exit();
    } else {
        echo "خطأ في الحذف: " . mysqli_error($conn);
    }
}
?>