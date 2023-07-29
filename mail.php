<?php

$subject = "HTML email";

$message = "
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<meta http-equiv='content-type' content='text/html; charset=utf-8' />
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' integrity='sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65' crossorigin='anonymous'>
<title>Reset password</title>

<style>
 
.container {
    text-align: end;
    color:  #2D3A3A;
}
</style>
</head>
<body>
<div class='container'>
         
  <h2><bdo dir='rtl'>سڵاو <bdo dir='ltr'>". $name."</bdo>, لە وێنەکانەوە👋✨</bdo></h2>
  <h3><bdo dir='rtl'>".$text."</bdo></h4> <br>
  <a href='".$link."'>".$link."</a>
</div>
</body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= "From: project" . "\r\n";
mail($to,$subject,$message,$headers)
?>