<?php
include('conf.php');
$userId = $_GET['userId'];
$followerId = $_GET['followerId'];
$avalable = $conn->query("select * from followers where user_id = '$userId' and follower_id = '$followerId'");
if($avalable->num_rows  == 0){
$res = $conn->query("insert into followers(user_id , follower_id) values('$userId', '$followerId')");
if($res){
    $sender_name = $conn->query("select username from users where id = '$followerId'")->fetch_column();
    $message = "فۆڵۆوی کردیت";
    $conn->query("insert into inbox (user_id, sender_id, message, user_link) value('$userId', '$followerId', '$message','$followerId' )");
    $conn->query("update users set inbox = 1 where id = '$userId'");
    $followCount = $conn->query("select count(*) from followers where user_id = '$userId' ")->fetch_column();
    if($followCount >= 500){
     $verified = "پیرۆزە، ئەکاونتەکەت ڤێریفای کرا";
     $is_verified = $conn->query("select verified from users where id = '$userId'")->fetch_column();
     if($is_verified == "0"){
     $conn->query("update users set verified = 1");
     $conn->query("insert into inbox (user_id,sender_id, message ) values('$userId','$followerId', '$verified')");
     }
    }
    echo($followCount);
}
}