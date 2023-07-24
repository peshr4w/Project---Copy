<?php
session_start();
include('conf.php');
$bio = cleanText($_POST['bio']);
$userId = $_POST['userId'];
function cleanText($text){
    $text = trim($text);
    $text = htmlspecialchars($text);
    $text = stripslashes($text);
    return $text;
}
$res = $conn->query("update users set bio = '$bio' where id = '$userId'");
if($res){
    $updated =  $conn->query("select bio from users where id = '$userId'")->fetch_column();
    if($updated){
        echo($updated);
    }
}


