<?php
session_start();
include('conf.php');
$sid = $_SESSION['user_id'];
$user_id = $conn->query("select id from users where session_id = '$sid'")->fetch_column();
$res = $conn->query("delete from posts where user_id ='$user_id'");
if ($res) {
    echo ("deleted");
}
