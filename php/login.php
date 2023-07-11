<?php
include("./conf.php");
session_start();
$res = "";

if (empty($_POST['username'])) {
    $res =  "ناوی بەکارهێنەر بەتاڵە";
} else if (strlen($_POST['username']) > 16) {
    $res =  "ناوی بەکارهێنەر دەبێت کەمتر بێت لە ١٦ پیت";
} else if (empty($_POST['password'])) {
    $res =  "وشەی نهێنی بەتاڵە";
} else if (strlen($_POST['password']) < 8) {
    $res = "وشەی نهێنی دەبێت لانیکەم ٨ پیت بێت";
} else {
    $password = md5($_POST['password']);
    $username = strtolower($_POST['username']);
    $result = $conn->query("select * from users where username = '$username' ");
    if ($result->num_rows > 0) {
        $rows = $result->fetch_assoc();
        if ($rows['password'] == $password) {
            $_SESSION['user_id']  = $rows['session_id'];
            $res = "success";
        } else {
            $res = "وشەی نهێنی هەڵەیە";
        }
    } else {
        $res =  "ناوی بەکارهێنەر بوونی نییە";
    }
}

echo $res;
