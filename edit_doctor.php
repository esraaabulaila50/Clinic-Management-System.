<?php 
session_start();
include('db.php'); 
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل بيانات الطبيب</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="bg-warning p-4 text-center text-dark">
                    <h2 class="fw-bold mb-0">تعديل بيانات الطبيب</h2>
                </div>
                <div class="card-body p-4">
                    <?php 
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM doctors WHERE id=$id";
                        $res = mysqli_query($conn, $sql );
                        $row = mysqli_fetch_assoc($res);
                    ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">اسم الطبيب</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">التخصص</label>
                            <input type="text" name="specialty" class="form-control" value="<?php echo $row['specialty']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">رقم الهاتف</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>" required>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <button type="submit" name="submit" class="btn btn-warning w-100 fw-bold">تحديث البيانات</button>
                        <a href="doctors.php" class="btn btn-light w-100 mt-2">إلغاء</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php 
if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $phone = $_POST['phone'];
    $sql2 = "UPDATE doctors SET name='$name', specialty='$specialty', phone='$phone' WHERE id=$id";
    if(mysqli_query($conn, $sql2)) { header('location: doctors.php'); }
}
?>
