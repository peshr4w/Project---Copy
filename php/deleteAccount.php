<?php
session_start();
include('conf.php');
$sid = $_SESSION['user_id'];
$user_id = $conn->query("select id from users where session_id = '$sid'")->fetch_column();
$pass = md5($_POST['pass']);
$user_pass = $conn->query("select password from users where id = '$user_id'")->fetch_column();
if ($pass == $user_pass) {
    $res = $conn->query("delete from users where id ='$user_id'");
    if ($res) {
        echo ("deleted");
        session_destroy();
    }
}else{
    echo("wrong-pass");
}
