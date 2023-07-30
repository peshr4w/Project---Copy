<?php
include('conf.php');

$pass = $_POST['password'];
$repass = $_POST['repassword'];
$email = $_POST['email'];
$code = $conn->query("select security_code from users where email = '$email'")->fetch_column();
$res = "";
if($code != $_REQUEST['code']){
    $res = "ببورە کێشەیەک هەیە، تکایە هەوڵبدەرەوە";
}
elseif ($pass == "" || $repass == "") {
    $res = "تکایە پاسوۆرد بنووسە";
} elseif ($pass != $repass) {
    $res = "پاسۆردەکان یەک ناگرنەوە";
} else if (strlen($pass) < 8) {
    $res = "وشەی نهێنی دەبێت بەلایەنی کەمەوە ٨ پیت بێت ";
} else if (!preg_match("$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$", $pass)) {
    $res = "وشەی نهێنی دەبێت پیتی گەورە و ژمارە و پیتی تایبەتی تێدابێت ";
} else {
    $pass = md5($pass);
    $done = $conn->query("update users set password = '$pass' where email = '$email'");
    if($done){
        $res = "success";
    }
    
}
echo($res);
