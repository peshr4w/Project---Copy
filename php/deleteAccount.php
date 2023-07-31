<?php
session_start();
include('conf.php');
$sid = $_SESSION['user_id'];
$user_id = $conn->query("select id from users where session_id = '$sid'")->fetch_column();
$res = $conn->query("delete from users where id ='$user_id'");
if ($res) {
    echo ("deleted");
    session_destroy();
}
