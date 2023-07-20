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
    include("./php/conf.php");
    $id = $_GET['id'];
    $post = $conn->query("select * from posts where id = '$id'")->fetch_assoc();
    ?>
    <title><?= 'Posts | '. $post['title'] ?></title>
</head>

<body>
    <?php
    include("./layout/logoutForm.php");

    ?>
    <?php
    include("./layout/navbar.php");
    ?>
    <script src="js/home.js"></script>
</body>

</html>