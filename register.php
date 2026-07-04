<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password']; // في المشاريع الطلابية نكتفي بكلمة السر كما هي
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    
    if (mysqli_query($conn, $sql)) {
        header("location: login.php?msg=تم التسجيل بنجاح، يمكنك الدخول الآن");
    } else {
        $error = "خطأ في التسجيل: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل حساب جديد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 450px;">
        <div class="card shadow">
            <div class="card-header bg-success text-white text-center"><h4>إنشاء حساب جديد</h4></div>
            <div class="card-body">
                <?php if(isset($error )) echo "<div class='alert alert-danger'>$error</div>"; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label>اسم المستخدم</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>كلمة المرور</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>الصلاحية</label>
                        <select name="role" class="form-control">
                            <option value="staff">موظف (Staff)</option>
                            <option value="admin">مدير (Admin)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">تسجيل</button>
                    <p class="text-center mt-3">لديك حساب؟ <a href="login.php">دخول</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
