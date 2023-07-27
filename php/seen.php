<?php
session_start();
include('conf.php');
$userId = $_GET['userId'];
$res = $conn->query("update users set inbox = 0 where id = '$userId'");
if($res){
    echo("seen");
}
