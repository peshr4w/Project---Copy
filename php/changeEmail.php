<?php
session_start();
include('conf.php');
$sid = $_SESSION['user_id'];
$user_id = $conn->query("select id from users where session_id = '$sid'")->fetch_column();
$email = secure($_POST['email']);
function secure($data)
{
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = trim($data);
    return $data;
}
if(filter_var($email, FILTER_VALIDATE_EMAIL )){
    $res = $conn->query("update users set email = '$email' where id = '$user_id'");
    if ($res) {
        echo ("changed");
    }
}else{
    echo("error");
}
