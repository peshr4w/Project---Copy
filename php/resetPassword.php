<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location:home.php');
}
include("conf.php");
$email = $_POST['email'];
$to = $name = $code = "";
$is_valid = $conn->query("select * from users where email = '$email'");
if ($is_valid->num_rows > 0) {
    $code = $conn->query("select security_code from users where email = '$email'")->fetch_column();
    echo ("success");
    $res =  $is_valid->fetch_assoc();
    $to  = $res['email'];
    $name = $res['username'];
    
}
$text = "ئەم لینکەی خوارەوە بەکار بهێنە  بۆ نوێکردنەوەی پاسوۆرد";
$link = "http://192.168.161.45/project/resetPassword.php?email=$email&code=$code";
include('../mail.php')
?>
