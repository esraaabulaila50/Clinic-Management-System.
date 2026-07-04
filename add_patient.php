<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("location: login.php"); exit(); }
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    
    mysqli_query($conn, "INSERT INTO patients (name, phone, gender, birthdate) VALUES ('$name', '$phone', '$gender', '$birthdate')");
    header("location: patients.php");
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة مريض - نظام العيادة</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .form-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; }
        .form-header { background: linear-gradient(135deg, #0d6efd 0%, #00d2ff 100%); color: white; padding: 40px; text-align: center; }
        .form-body { padding: 40px; background: white; }
        .form-control, .form-select { border-radius: 10px; padding: 12px; border: 1px solid #f1f1f1; background-color: #f8f9fa; }
        .form-control:focus { background-color: #fff; box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.05); }
        .input-icon { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #adb5bd; }
        .input-group { position: relative; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-card shadow">
                    <div class="form-header">
                        <i class="fas fa-user-plus fa-3x mb-3"></i>
                        <h2 class="fw-bold">إضافة مريض جديد</h2>
                        <p class="mb-0 opacity-75">يرجى ملء البيانات التالية بدقة لفتح سجل جديد</p>
                    </div>
                    <div class="form-body">
                        <form method="POST" id="patientForm">
                            <div class="mb-4">
                                <label class="form-label fw-bold">الاسم الكامل للمريض</label>
                                <div class="input-group">
                                    <input type="text" name="name" class="form-control" placeholder="مثال: أحمد محمد علي" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">رقم الجوال</label>
                                <div class="input-group">
                                    <input type="text" name="phone" class="form-control" placeholder="05xxxxxxxx" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">الجنس</label>
                                    <select name="gender" class="form-select">
                                        <option value="Male">ذكر</option>
                                        <option value="Female">أنثى</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">تاريخ الميلاد</label>
                                    <input type="date" name="birthdate" class="form-control" required>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">حفظ بيانات المريض</button>
                                <a href="patients.php" class="btn btn-light btn-lg rounded-pill text-muted">إلغاء والعودة</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('patientForm').onsubmit = function(e) {
            let phone = document.getElementsByName('phone')[0].value;
            if (phone.length < 9 || isNaN(phone)) {
                alert("يرجى إدخال رقم هاتف صحيح");
                e.preventDefault();
            }
        };
    </script>
</body>
</html>
