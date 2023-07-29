<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (isset($_SESSION['user_id'])) {
   // header('Location:home.php');
}
?>

<head>
    <?php include("./layout/head.php") ?>
    <?php include("./php/conf.php") ?>
    <title>resetPassword</title>
</head>

<body>
    <?php include("./layout/logoutForm.php"); ?>
    <?php include("./layout/navbar.php") ?>
      <div class="container d-flex justify-content-center">
        <div class="col-sm-12 col-md-6 mt-5">
            <form action="" method="post">
                <div class="form-group mb-2">
                    <label for="email" class="form-label d-flex justify-content-end"><bdo dir="rtl">ئیمەیڵ</bdo></label>
                    <input type="text" name="email" id="email" class="form-control rounded-3 verify-email-input">
                </div>
                <div class="form-group d-flex align-items-end">
                    <button class="btn ms-auto verify-email-btn p-1 rounded-4 text-white px-2 w-25" disabled><small> <bdo dir="rtl">ناردن</bdo></small></button>
                </div>

            </form>
        </div>
      </div>

    <script src="js/home.js"></script>

</body>

</html>