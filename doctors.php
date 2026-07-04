<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("location: login.php"); exit(); }
include('db.php');

$query = "SELECT * FROM doctors ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الأطباء - نظام العيادة</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .page-header { background: #fff; padding: 40px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 40px; }
        .doctor-card { 
            border: none; border-radius: 20px; transition: 0.3s; 
            background: white; overflow: hidden; height: 100%;
        }
        .doctor-card:hover { transform: translateY(-10px); box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
        .doctor-avatar { 
            background: linear-gradient(135deg, #0d6efd 0%, #00d2ff 100%); 
            height: 120px; display: flex; align-items: center; justify-content: center;
            color: white; font-size: 50px;
        }
        .doctor-info { padding: 25px; text-align: center; }
        .specialty-badge { background: rgba(13, 110, 253, 0.1); color: #0d6efd; padding: 5px 15px; border-radius: 50px; font-size: 14px; font-weight: 600; }
        .btn-action-group { border-top: 1px solid #f1f1f1; padding: 15px; display: flex; justify-content: center; gap: 10px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php"><i class="fas fa-arrow-right me-2"></i> العودة للرئيسية</a>
        </div>
    </nav>

    <div class="page-header text-center">
        <div class="container">
            <h2 class="fw-bold">فريق الأطباء المتخصصين</h2>
            <p class="text-muted">نخبة من أفضل الأطباء في كافة التخصصات الطبية</p>
            <a href="add_doctor.php" class="btn btn-success rounded-pill px-5 py-2 shadow-sm mt-3">
                <i class="fas fa-plus me-2"></i> إضافة طبيب جديد
            </a>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row g-4">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4 col-lg-3">
                <div class="doctor-card shadow-sm">
                    <div class="doctor-avatar">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="doctor-info">
                        <h5 class="fw-bold mb-2">د. <?php echo $row['name']; ?></h5>
                        <div class="mb-3">
                            <span class="specialty-badge"><?php echo $row['specialty']; ?></span>
                        </div>
                        <p class="text-muted small mb-0"><i class="fas fa-phone-alt me-1"></i> <?php echo $row['phone']; ?></p>
                    </div>
                    <div class="btn-action-group">
                        <a href="edit_doctor.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3"><i class="fas fa-edit me-1"></i> تعديل</a>
                        <?php if($_SESSION['role'] == 'admin'): ?>
                        <a href="delete_doctor.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="return confirm('حذف الطبيب؟')"><i class="fas fa-trash me-1"></i> حذف</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
