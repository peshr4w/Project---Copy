<?php
include('conf.php');
$post_id = $_GET['postId'];
$res = $conn->query("delete from posts where  id = '$post_id'");
if($res){
    echo('deleted');
}