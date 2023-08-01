<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/fd93baf7b6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../index.css">
    <link rel="shortcut icon" href="icon-sm.png" type="image/x-icon">

    <title>Update profile picture</title>
</head>

<body>
    <?php
    include('conf.php');
    $user_id = $_SESSION['user_id'];
    $uid = $conn->query("select id from users where session_id = '$user_id'")->fetch_column();
    if (isset($_FILES['profileImage'])) {

        $ext =  strtolower(pathinfo($_FILES['profileImage']['name'], PATHINFO_EXTENSION));

        $imgName = "IMG_" . date("Ymdhis") . "_" . random_int(1000000, 9999999) . "." . $ext;
        $av = $conn->query("select image from users where image = '$imgName'");
        if ($av->num_rows > 0) {
            $image_name = "IMG_" . date("Ymdhis") . "_" . random_int(2000000, 9999999) . "." . $ext;
        }

        $exts = ["png", "jpg", "jpeg", "gif"];

        $error = "";

        if ($_FILES["profileImage"]["size"] >  5242880) {
            $error = "قەبارەی وێنەکە دەبێت کەمتر بێت لە ٥ مێگابایت";
        } elseif (!in_array($ext, $exts)) {
            $error = "ببورە کێشەیەک هەیە، تکایە هەوڵبدەرەوە";
        } else {

            $imgTmp = $_FILES['profileImage']['tmp_name'];
            $oldImg = $conn->query("select image from users where session_id = '$user_id'")->fetch_column();
            $updateImage = $conn->query("update users set image = '$imgName' where session_id = '$user_id'");
            if ($updateImage) {
                move_uploaded_file($imgTmp, '../images/users/' . $imgName);
                if ($oldImg != 'profile.png') {
                    unlink('../images/users/' . $oldImg);
                }
                $msg = "✨وێنەی پڕۆفایل گۆڕدرا";
                $url = "../profile.php?id=" . $uid . "&msg=$msg";
                header("Location:$url");
            }
        }
    }
    if ($error != "") { ?>
    <div class="container pt-5">
    <div class="card p-3 text-center rounded-4"><?= $error ?>
    <a href="<?= 'profile.php?id='.$ui ?>" class="text-secondary"><bdo dir="rtl">گەڕانەوە</bdo></a>
    </div>
    </div>
       
   <?php }
    ?>
</body>

</html>