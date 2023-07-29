<?php 
session_start();
include('./conf.php');

$res = "";

        $username = strtolower(secure($_POST['username']));
        $email = strtolower(secure($_POST['email']));
        $result = $conn->query("select  * from users where username = '$username'");
        $result1 = $conn->query("select  * from users where email = '$email'");
        if ($result->num_rows > 0) {
            $res = "ناوی تێپەڕ پێشتر بەکارهاتوە";
        } else if (empty($_POST['username'])) {
            $res = "ناوی بەکارهێنەر بەتاڵە";
        }  else if (!preg_match("/^[a-zA-Z-\_\.\-0-9+]*$/", $_POST['username'])) {
            $res =  "ناوی بەکارهێنەر دەبێت ژمارە , پیت ,_ و . تەنها!";
        } else if (strlen($_POST['username']) > 16) {
            $res =  "ناوی بەکارهێنەر دەبێت کەمتر بێت لە ٦١ پیت";
        }else if ($result1->num_rows > 0) {
            $res =  "ئیمەیڵ پێشتر بەکارهاتووە";
        }else if (empty($_POST['email'])) {
            $res = "ئیمەیڵ بەتاڵە";
        }else if (!filter_var(($_POST['email']), FILTER_VALIDATE_EMAIL)) {
            $res = "ئیمەیڵەکە نادروستە";
        } else if (empty($_POST['password1'])) {
            $res =  "پاسۆرد بەتاڵە";
        } else if (!preg_match("$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$", $_POST['password1'])) {
            $res = "وشەی نهێنی دەبێت پیتی گەورە و ژمارە و پیتی تایبەتی تێدابێت ";
        } else if (strlen($_POST['password1']) < 8) {
            $res = "وشەی نهێنی دەبێت بەلایەنی کەمەوە ٨ پیت بێت ";
        } else if (empty($_POST['password2'])) {
            $res =  "وشەی نهێنی دووبارە نووسینەوە بەتاڵە";
        } else if ($_POST['password1'] !== $_POST['password2'] ) {
            $res =  "پاسۆردەکان یەک ناگرنەوە";
        }   else {
            $email = $_POST['email'];
            $session = time();
            $username = secure($_POST['username']);
            $password = md5($_POST['password1']);

            $_SESSION['user_id'] = $session;
            $sql = "insert into users(username,email,session_id,password) values( '$username','$email','$session','$password')";
            if ($conn->query($sql)) {
                $res = "success";
            }
        }
        echo $res;

   
function secure($data)
{
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = trim($data);
    return $data;
}
