<?php
session_start();
include('conf.php');
$post_id = $_GET['postId'];
$user_id = $_GET['userId'];
$res = $conn->query("insert into likes(user_id ,post_id) values('$user_id', '$post_id')");
if($res){
    $author_id = $conn->query("select user_id from posts where id = '$post_id'")->fetch_column();
    $sender_name = $conn->query("select username from users where id = '$user_id'")->fetch_column();
    $conn->query("update users set inbox = 1 where id = '$author_id'");
    $message =  "پۆستەکەتی لایک کرد";
    
    $conn->query("insert into inbox (user_id, sender_id, message, link, user_link) value( '$author_id','$user_id', '$message', '$post_id', '$user_id')");
    $likesCount = $conn->query("select count(*) from likes where post_id = '$post_id' ")->fetch_column();
    if($likesCount){
        echo $likesCount;
    }
}