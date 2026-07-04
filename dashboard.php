<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    exit();
}
include('db.php');
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - نظام العيادة</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --primary-gradient: linear-gradient(135deg, #0d6efd 0%, #00d2ff 100%); }
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .hero-section { 
            background: var(--primary-gradient), url('assets/bg.png'); 
            background-blend-mode: overlay;
            background-size: cover;
            border-radius: 20px;
            padding: 60px;
            color: white;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(13, 110, 253, 0.2);
        }
        .stat-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
            height: 100%;
            background: #fff;
        }
        .stat-card:hover { transform: translateY(-10px); box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
        .stat-icon { 
            width: 60px; height: 60px; 
            border-radius: 15px; 
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; margin-bottom: 20px;
        }
        .bg-light-primary { background: rgba(13, 110, 253, 0.1); color: #0d6efd; }
        .bg-light-success { background: rgba(25, 135, 84, 0.1); color: #198754; }
        .bg-light-info { background: rgba(13, 202, 240, 0.1); color: #0dcaf0; }
        .nav-link { font-weight: 500; color: #444; }
        .nav-link:hover { color: #0d6efd; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <img src="assets/logo.png" alt="Logo" width="40" class="me-2"> عيادتي الذكية
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link px-3 active" href="dashboard.php">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="patients.php">المرضى</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="doctors.php">الأطباء</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="appointments.php">المواعيد</a></li>
                    <li class="nav-item ms-lg-3">
                        <div class="dropdown">
                            <a class="btn btn-outline-primary rounded-pill dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> <?php echo $_SESSION['username']; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> الإعدادات</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> تسجيل الخروج</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Hero Section -->
        <div class="hero-section">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold mb-3">أهلاً بك في نظام إدارة العيادة</h1>
                    <p class="lead mb-4">نظام متطور يسهل عليك إدارة كافة العمليات اليومية للعيادة بكفاءة عالية وتنظيم دقيق.</p>
                    <div class="d-flex gap-3">
                        <a href="add_appointment.php" class="btn btn-light btn-lg rounded-pill px-4 fw-bold text-primary">حجز موعد جديد</a>
                        <a href="add_patient.php" class="btn btn-outline-light btn-lg rounded-pill px-4">إضافة مريض</a>
                    </div>
                </div>
                <div class="col-lg-4 d-none d-lg-block">
                    <img src="assets/clinic_icon.png" alt="Clinic" class="img-fluid" style="max-height: 250px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2));">
                </div>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card stat-card p-4 shadow-sm" onclick="location.href='patients.php'">
                    <div class="stat-icon bg-light-primary"><i class="fas fa-user-injured"></i></div>
                    <h3 class="fw-bold">المرضى</h3>
                    <p class="text-muted">إدارة سجلات المرضى، التاريخ الطبي، والبيانات الشخصية.</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="badge bg-primary rounded-pill">عرض الكل</span>
                        <i class="fas fa-arrow-left text-primary"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card p-4 shadow-sm" onclick="location.href='doctors.php'">
                    <div class="stat-icon bg-light-success"><i class="fas fa-user-md"></i></div>
                    <h3 class="fw-bold">الأطباء</h3>
                    <p class="text-muted">تنظيم بيانات الأطباء، التخصصات، وساعات العمل.</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="badge bg-success rounded-pill">عرض الكل</span>
                        <i class="fas fa-arrow-left text-success"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card p-4 shadow-sm" onclick="location.href='appointments.php'">
                    <div class="stat-icon bg-light-info"><i class="fas fa-calendar-check"></i></div>
                    <h3 class="fw-bold">المواعيد</h3>
                    <p class="text-muted">متابعة المواعيد القادمة، تأكيد الحجوزات، والجدول الزمني.</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="badge bg-info rounded-pill text-dark">عرض الكل</span>
                        <i class="fas fa-arrow-left text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
