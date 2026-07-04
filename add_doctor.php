<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("location: login.php"); exit(); }
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $specialty = mysqli_real_escape_string($conn, $_POST['specialty']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    
    mysqli_query($conn, "INSERT INTO doctors (name, specialty, phone) VALUES ('$name', '$specialty', '$phone')");
    header("location: doctors.php");
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة طبيب - نظام العيادة</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .form-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; }
        .form-header { background: linear-gradient(135deg, #198754 0%, #20c997 100%); color: white; padding: 40px; text-align: center; }
        .form-body { padding: 40px; background: white; }
        .form-control { border-radius: 10px; padding: 12px; border: 1px solid #f1f1f1; background-color: #f8f9fa; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-card shadow">
                    <div class="form-header">
                        <i class="fas fa-user-md fa-3x mb-3"></i>
                        <h2 class="fw-bold">إضافة طبيب جديد</h2>
                        <p class="mb-0 opacity-75">أضف كفاءة جديدة لفريقك الطبي</p>
                    </div>
                    <div class="form-body">
                        <form method="POST">
                            <div class="mb-4">
                                <label class="form-label fw-bold">اسم الطبيب</label>
                                <input type="text" name="name" class="form-control" placeholder="د. اسم الطبيب" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">التخصص</label>
                                <input type="text" name="specialty" class="form-control" placeholder="مثال: طب أطفال، قلب، عيون" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">رقم الهاتف</label>
                                <input type="text" name="phone" class="form-control" placeholder="05xxxxxxxx" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm">حفظ بيانات الطبيب</button>
                                <a href="doctors.php" class="btn btn-light btn-lg rounded-pill text-muted">إلغاء والعودة</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
