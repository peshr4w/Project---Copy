<?php
session_start();
include('conf.php');
$user_id = $_SESSION['user_id'];
$uid = $conn->query("select id from users where session_id = '$user_id'")->fetch_column();
if (isset($_FILES['profileImage'])) {
    $imgName = time() . $_FILES['profileImage']['name'];
    $imgTmp = $_FILES['profileImage']['tmp_name'];
    $oldImg = $conn->query("select image from users where session_id = '$user_id'")->fetch_column();
    $updateImage = $conn->query("update users set image = '$imgName' where session_id = '$user_id'");
    if ($updateImage) {
        move_uploaded_file($imgTmp, '../images/users/' . $imgName);
        if($oldImg != 'profile.png'){
        unlink('../images/users/' . $oldImg);
        }
        $msg = "✨وێنەی پڕۆفایل گۆڕدرا";
        $url = "../profile.php?id=".$uid."&msg=$msg";
        header("Location:$url");
    }
}
