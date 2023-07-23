<?php
include('conf.php');
$userId = $_GET['userId'];
$followerId = $_GET['followerId'];
$avalable = $conn->query("select * from followers where user_id = '$userId' and follower_id = '$followerId'");
if($avalable->num_rows  == 0){
$res = $conn->query("insert into followers(user_id , follower_id) values('$userId', '$followerId')");
if($res){
    $followCount = $conn->query("select count(*) from followers where user_id = '$userId' ")->fetch_column();
    echo($followCount);
}
}