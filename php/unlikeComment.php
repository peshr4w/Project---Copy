<?php
include('conf.php');
$userId = $_POST['userId'];
$commentId = $_POST['commentId'];
$res = $conn->query("delete from comment_likes where user_id = '$userId'  and  comment_id = '$commentId'");
if ($res) {
    $likesCount = $conn->query("select count(*) from comment_likes where comment_id = '$commentId' ")->fetch_column();
    if ($likesCount) {
        echo ($likesCount);
    }
}
