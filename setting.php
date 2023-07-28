<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:index.php');
}
?>
<html lang="en">

<head>
    <?php
    include("./layout/head.php");
    ?>
    <title>Setting</title>
</head>

<body>
    <?php include("./php/conf.php"); ?>
    <?php include("./layout/logoutForm.php"); ?>
    <?php include("./layout/navbar.php") ?>
    <div class="container py-5">
    
    </div>
    <?php
    $session_id = $_SESSION['user_id'];
    $user_id = $conn->query("select id from users where session_id = '$session_id'")->fetch_column();
    ?>
    <input type="hidden" value="<?= $user_id ?>" id="userId">
</body>

<script src="js/home.js"></script>

</html>