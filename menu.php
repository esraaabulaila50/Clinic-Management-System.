<?php include('../config/constants.php'); check_login(); ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام إدارة العيادة</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --primary-color: #0d6efd; --secondary-color: #6c757d; }
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .nav-link { font-weight: 500; color: #444; transition: 0.3s; }
        .nav-link:hover { color: var(--primary-color); }
        .active-nav { color: var(--primary-color) !important; font-weight: 700; }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="index.php">
                <img src="../assets/logo.png" alt="Logo" width="40" class="me-2"> عيادتي الذكية
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link px-3" href="index.php">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="manage-patients.php">المرضى</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="manage-doctors.php">الأطباء</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="manage-appointments.php">المواعيد</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="manage-admin.php">المدراء</a></li>
                    <li class="nav-item ms-lg-3">
                        <div class="dropdown">
                            <a class="btn btn-outline-primary rounded-pill dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> <?php echo $_SESSION['username']; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                <li><a class="dropdown-item" href="update-password.php"><i class="fas fa-key me-2"></i> تغيير كلمة المرور</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> تسجيل الخروج</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
