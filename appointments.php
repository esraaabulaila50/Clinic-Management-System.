<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("location: login.php"); exit(); }
include('db.php');

$query = "SELECT a.*, p.name as patient_name, d.name as doctor_name 
          FROM appointments a 
          JOIN patients p ON a.patient_id = p.id 
          JOIN doctors d ON a.doctor_id = d.id 
          ORDER BY a.appointment_date DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جدول المواعيد - نظام العيادة</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .page-header { background: #fff; padding: 30px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 30px; }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .table thead { background: #f8f9fa; }
        .table th { border: none; padding: 15px; color: #6c757d; font-weight: 600; }
        .table td { vertical-align: middle; padding: 15px; border-bottom: 1px solid #f1f1f1; }
        .date-badge { background: #f0f4f8; color: #0d6efd; padding: 8px 12px; border-radius: 10px; font-weight: 600; font-size: 14px; }
        .time-badge { background: #fff3cd; color: #856404; padding: 8px 12px; border-radius: 10px; font-weight: 600; font-size: 14px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-dark" href="dashboard.php"><i class="fas fa-arrow-right me-2"></i> العودة للرئيسية</a>
        </div>
    </nav>

    <div class="page-header">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-0">جدول المواعيد</h2>
                <p class="text-muted mb-0">متابعة وتنظيم كافة حجوزات المرضى</p>
            </div>
            <a href="add_appointment.php" class="btn btn-info rounded-pill px-4 shadow-sm fw-bold">
                <i class="fas fa-calendar-plus me-2"></i> حجز موعد جديد
            </a>
        </div>
    </div>

    <div class="container mb-5">
        <div class="card p-4">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>المريض</th>
                            <th>الطبيب</th>
                            <th>التاريخ</th>
                            <th>الوقت</th>
                            <th>ملاحظات</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>
                                <div class="fw-bold text-primary"><?php echo $row['patient_name']; ?></div>
                            </td>
                            <td>
                                <div class="text-dark"><i class="fas fa-user-md me-1 text-muted"></i> د. <?php echo $row['doctor_name']; ?></div>
                            </td>
                            <td><span class="date-badge"><i class="far fa-calendar-alt me-1"></i> <?php echo $row['appointment_date']; ?></span></td>
                            <td><span class="time-badge"><i class="far fa-clock me-1"></i> <?php echo $row['appointment_time']; ?></span></td>
                            <td class="text-muted small"><?php echo $row['reason'] ? $row['reason'] : 'لا توجد'; ?></td>
                            <td>
                                <a href="edit_appointment.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-secondary btn-sm rounded-pill"><i class="fas fa-edit"></i></a>
                                <?php if($_SESSION['role'] == 'admin'): ?>
                                <a href="delete_appointment.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger btn-sm rounded-pill" onclick="return confirm('إلغاء الموعد؟')"><i class="fas fa-times"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
