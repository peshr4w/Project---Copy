<?php
include('conf.php');
$userId = $_POST['userId'];
$commentId = $_POST['commentId'];
$res = $conn->query("insert into comment_likes(user_id, comment_id)  values('$userId', '$commentId')");
if ($res) {
    $likesCount = $conn->query("select count(*) from comment_likes where comment_id = '$commentId' ")->fetch_column();
    if ($likesCount) {
        echo ($likesCount);
    }
}
