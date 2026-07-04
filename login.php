<?php
session_start();
include('db.php');

$remembered_user = isset($_COOKIE['user_login']) ? $_COOKIE['user_login'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    $user = mysqli_fetch_assoc($result);
    
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        
        if (isset($_POST['remember'])) {
            setcookie("user_login", $username, time() + (24 * 60 * 60 * 7), "/"); 
        }
        
        header("location: dashboard.php");
        exit();
    } else {
        $error = "خطأ في اسم المستخدم أو كلمة المرور!";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - نظام إدارة العيادة</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --primary-color: #0d6efd; --secondary-color: #6c757d; }
        body, html { height: 100%; margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow: hidden; }
        .login-wrapper { display: flex; height: 100vh; }
        .login-image { flex: 1; background: url('assets/doctor.jpg') no-repeat center center; background-size: cover; position: relative; }
        .login-image::after { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(13, 110, 253, 0.2); }
        .login-form-container { width: 450px; display: flex; flex-direction: column; justify-content: center; padding: 40px; background: #fff; z-index: 1; box-shadow: -5px 0 15px rgba(0,0,0,0.1); }
        .brand-logo { width: 80px; margin-bottom: 20px; }
        .btn-primary { border-radius: 50px; padding: 12px; font-weight: 600; }
        .form-control { border-radius: 10px; padding: 12px; border: 1px solid #dee2e6; }
        .form-control:focus { box-shadow: 0 0 0 0.25 row rgba(13, 110, 253, 0.1); }
        @media (max-width: 768px) { .login-image { display: none; } .login-form-container { width: 100%; } }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-image">
            <div class="position-absolute bottom-0 start-0 p-5 text-white" style="z-index: 2;">
                <h1 class="display-4 fw-bold">نظام العيادة الذكي</h1>
                <p class="lead">إدارة متكاملة للمرضى، الأطباء، والمواعيد في مكان واحد.</p>
            </div>
        </div>
        <div class="login-form-container">
            <div class="text-center mb-4">
                <img src="assets/logo.png" alt="Logo" class="brand-logo">
                <h2 class="fw-bold text-dark">مرحباً بك مجدداً</h2>
                <p class="text-muted">يرجى تسجيل الدخول للوصول إلى لوحة التحكم</p>
            </div>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> <?php echo $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form method="POST" id="loginForm">
                <div class="mb-3">
                    <label class="form-label fw-semibold">اسم المستخدم</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="fas fa-user text-muted"></i></span>
                        <input type="text" name="username" class="form-control bg-light border-0" placeholder="أدخل اسم المستخدم" value="<?php echo $remembered_user; ?>" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">كلمة المرور</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="fas fa-lock text-muted"></i></span>
                        <input type="password" name="password" class="form-control bg-light border-0" placeholder="أدخل كلمة المرور" required>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="rememberMe" <?php echo $remembered_user ? 'checked' : ''; ?>>
                        <label class="form-check-label small text-muted" for="rememberMe">تذكرني على هذا الجهاز</label>
                    </div>
                    <a href="#" class="small text-decoration-none">نسيت كلمة المرور؟</a>
                </div>
                <button type="submit" class="btn btn-primary w-100 shadow-sm mb-3">تسجيل الدخول</button>
                <div class="text-center">
                    <span class="text-muted small">ليس لديك حساب؟ <a href="register.php" class="text-decoration-none fw-bold">أنشئ حساباً الآن</a></span>
                </div>
            </form>
            
            <div class="mt-auto pt-5 text-center text-muted small">
                &copy; 2026 جميع الحقوق محفوظة - مشروع التخرج
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
