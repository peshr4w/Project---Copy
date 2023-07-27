<?php
session_start();
include('conf.php');
$post_id = $_GET['postId'];
$user_id = $_GET['userId'];
$res = $conn->query("insert into likes(user_id ,post_id) values('$user_id', '$post_id')");
if($res){
    $author_id = $conn->query("select user_id from posts where id = '$post_id'")->fetch_column();
    $sender_name = $conn->query("select username from users where id = '$user_id'")->fetch_column();

    $message =  "پۆستەکەتی لایک کرد ".$sender_name;
    $conn->query("insert into inbox (user_id, sender_id, message) value( '$author_id','$user_id', '$message')");
    $likesCount = $conn->query("select count(*) from likes where post_id = '$post_id' ")->fetch_column();
    if($likesCount){
        echo $likesCount;
    }
}