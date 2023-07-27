<?php
include("conf.php");
$image_name = $_GET['imageName'];
$categories = $_GET['categories'];
echo($image_name." ".$categories);
$res = $conn->query("update posts set categories = '$categories' where image = '$image_name'");
if($res){
    echo("Set");
}