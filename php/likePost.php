<?php
session_start();
include('conf.php');
$post_id = $_GET['postId'];
$user_id = $_GET['userId'];
$res = $conn->query("insert into likes(user_id ,post_id) values('$user_id', '$post_id')");
if($res){
    echo('liked');
}