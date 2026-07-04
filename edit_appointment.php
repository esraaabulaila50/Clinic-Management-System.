<?php 
session_start();
include('db.php'); 
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل موعد</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="bg-warning p-4 text-center">
                    <h2 class="fw-bold mb-0">تعديل موعد</h2>
                </div>
                <div class="card-body p-4">
                    <?php 
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM appointments WHERE id=$id";
                        $res = mysqli_query($conn, $sql );
                        $row = mysqli_fetch_assoc($res);
                    ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">تاريخ الموعد</label>
                            <input type="date" name="appointment_date" class="form-control" value="<?php echo $row['appointment_date']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">وقت الموعد</label>
                            <input type="time" name="appointment_time" class="form-control" value="<?php echo $row['appointment_time']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">سبب الزيارة</label>
                            <textarea name="reason" class="form-control" rows="3"><?php echo $row['reason']; ?></textarea>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <button type="submit" name="submit" class="btn btn-warning w-100 fw-bold">تحديث الموعد</button>
                        <a href="appointments.php" class="btn btn-light w-100 mt-2">إلغاء</a>
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
    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];
    $reason = $_POST['reason'];
    $sql2 = "UPDATE appointments SET appointment_date='$date', appointment_time='$time', reason='$reason' WHERE id=$id";
    if(mysqli_query($conn, $sql2)) { header('location: appointments.php'); }
}
?>
