<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("location: login.php"); exit(); }
include('db.php');

$patients = mysqli_query($conn, "SELECT id, name FROM patients");
$doctors = mysqli_query($conn, "SELECT id, name FROM doctors");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);
    
    mysqli_query($conn, "INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, reason) 
                        VALUES ('$patient_id', '$doctor_id', '$date', '$time', '$reason')");
    header("location: appointments.php");
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حجز موعد - نظام العيادة</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .form-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; }
        .form-header { background: linear-gradient(135deg, #0dcaf0 0%, #0097b2 100%); color: white; padding: 40px; text-align: center; }
        .form-body { padding: 40px; background: white; }
        .form-control, .form-select { border-radius: 10px; padding: 12px; border: 1px solid #f1f1f1; background-color: #f8f9fa; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="form-card shadow">
                    <div class="form-header">
                        <i class="fas fa-calendar-check fa-3x mb-3"></i>
                        <h2 class="fw-bold">حجز موعد جديد</h2>
                        <p class="mb-0 opacity-75">قم بتنظيم مواعيد المرضى بسهولة</p>
                    </div>
                    <div class="form-body">
                        <form method="POST">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">اختر المريض</label>
                                    <select name="patient_id" class="form-select" required>
                                        <option value="">-- اختر مريضاً --</option>
                                        <?php while($p = mysqli_fetch_assoc($patients)): ?>
                                            <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">اختر الطبيب</label>
                                    <select name="doctor_id" class="form-select" required>
                                        <option value="">-- اختر طبيباً --</option>
                                        <?php while($d = mysqli_fetch_assoc($doctors)): ?>
                                            <option value="<?php echo $d['id']; ?>">د. <?php echo $d['name']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">تاريخ الموعد</label>
                                    <input type="date" name="appointment_date" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">وقت الموعد</label>
                                    <input type="time" name="appointment_time" class="form-control" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">سبب الزيارة (اختياري)</label>
                                <textarea name="reason" class="form-control" rows="3" placeholder="اكتب سبباً مختصراً للزيارة..."></textarea>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-info btn-lg rounded-pill shadow-sm fw-bold text-dark">تأكيد الحجز</button>
                                <a href="appointments.php" class="btn btn-light btn-lg rounded-pill text-muted">إلغاء والعودة</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
