<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("location: login.php"); exit(); }
include('db.php');

$query = "SELECT * FROM patients ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المرضى - نظام العيادة</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .page-header { background: #fff; padding: 30px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 30px; }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .table thead { background: #f8f9fa; }
        .table th { border: none; padding: 15px; color: #6c757d; font-weight: 600; }
        .table td { vertical-align: middle; padding: 15px; border-bottom: 1px solid #f1f1f1; }
        .btn-action { width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; transition: 0.3s; }
        .btn-edit { background: rgba(13, 110, 253, 0.1); color: #0d6efd; }
        .btn-delete { background: rgba(220, 53, 69, 0.1); color: #dc3545; }
        .btn-edit:hover { background: #0d6efd; color: #fff; }
        .btn-delete:hover { background: #dc3545; color: #fff; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php"><i class="fas fa-arrow-right me-2"></i> العودة للرئيسية</a>
        </div>
    </nav>

    <div class="page-header">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-0">سجل المرضى</h2>
                <p class="text-muted mb-0">إدارة وعرض كافة بيانات المرضى المسجلين</p>
            </div>
            <a href="add_patient.php" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="fas fa-plus me-2"></i> إضافة مريض جديد
            </a>
        </div>
    </div>

    <div class="container">
        <div class="card p-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم الكامل</th>
                            <th>رقم الهاتف</th>
                            <th>الجنس</th>
                            <th>تاريخ الميلاد</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td class="fw-bold text-muted"><?php echo $row['id']; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle p-2 me-3 text-primary"><i class="fas fa-user"></i></div>
                                    <span class="fw-bold"><?php echo $row['name']; ?></span>
                                </div>
                            </td>
                            <td><i class="fas fa-phone-alt me-2 text-muted small"></i><?php echo $row['phone']; ?></td>
                            <td>
                                <span class="badge <?php echo $row['gender'] == 'Male' ? 'bg-info text-dark' : 'bg-danger'; ?> rounded-pill">
                                    <?php echo $row['gender'] == 'Male' ? 'ذكر' : 'أنثى'; ?>
                                </span>
                            </td>
                            <td><?php echo $row['birthdate']; ?></td>
                            <td>
                                <a href="edit_patient.php?id=<?php echo $row['id']; ?>" class="btn-action btn-edit me-2" title="تعديل"><i class="fas fa-edit"></i></a>
                                <?php if($_SESSION['role'] == 'admin'): ?>
                                <a href="delete_patient.php?id=<?php echo $row['id']; ?>" class="btn-action btn-delete" title="حذف" onclick="return confirm('هل أنت متأكد من الحذف؟')"><i class="fas fa-trash"></i></a>
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
