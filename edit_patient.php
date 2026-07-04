<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("location: login.php"); exit(); }
include('db.php');

$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM patients WHERE id = $id");
$patient = mysqli_fetch_assoc($res);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    
    mysqli_query($conn, "UPDATE patients SET name='$name', phone='$phone', gender='$gender', birthdate='$birthdate' WHERE id=$id");
    header("location: patients.php");
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل بيانات مريض - نظام العيادة</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .form-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; }
        .form-header { background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); color: white; padding: 40px; text-align: center; }
        .form-body { padding: 40px; background: white; }
        .form-control, .form-select { border-radius: 10px; padding: 12px; border: 1px solid #f1f1f1; background-color: #f8f9fa; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-card shadow">
                    <div class="form-header">
                        <i class="fas fa-user-edit fa-3x mb-3"></i>
                        <h2 class="fw-bold text-dark">تعديل بيانات مريض</h2>
                        <p class="mb-0 text-dark opacity-75">تحديث معلومات المريض: <?php echo $patient['name']; ?></p>
                    </div>
                    <div class="form-body">
                        <form method="POST">
                            <div class="mb-4">
                                <label class="form-label fw-bold">الاسم الكامل</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $patient['name']; ?>" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">رقم الجوال</label>
                                <input type="text" name="phone" class="form-control" value="<?php echo $patient['phone']; ?>" required>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">الجنس</label>
                                    <select name="gender" class="form-select">
                                        <option value="Male" <?php if($patient['gender'] == 'Male') echo 'selected'; ?>>ذكر</option>
                                        <option value="Female" <?php if($patient['gender'] == 'Female') echo 'selected'; ?>>أنثى</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">تاريخ الميلاد</label>
                                    <input type="date" name="birthdate" class="form-control" value="<?php echo $patient['birthdate']; ?>" required>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-warning btn-lg rounded-pill shadow-sm fw-bold">تحديث البيانات</button>
                                <a href="patients.php" class="btn btn-light btn-lg rounded-pill text-muted">إلغاء والعودة</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
