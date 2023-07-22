<?php
session_start();
include('conf.php');
$post_id = $_GET['postId'];
$user_id = $_GET['userId'];
$res = $conn->query("delete from likes where user_id = '$user_id' and post_id = '$post_id'");
if($res){
    echo('unliked');
}