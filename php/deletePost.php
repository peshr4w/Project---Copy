<?php
include('conf.php');
$post_id = $_GET['postId'];
$file = $conn->query("select image from posts where  id = '$post_id'")->fetch_column();
if($file){
$res = $conn->query("delete from posts where  id = '$post_id'");
if($res){
    echo('deleted');
    if(unlink('../images/uploads/'.$file)){
        echo("file deleted");
    }
}
}