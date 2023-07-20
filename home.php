<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:index.php');
}
?>
<html lang="en">

<head>
    <?php include("./layout/head.php"); ?>
    <title>Home</title>
</head>

<body>
<div class="logout position-fixed top-0 left-0">
    <div class="logout-form rounded bg-white rounded-4 text-center p-3 shadow mx-auto w-25 ">
        <button class="close ms-auto btn-close btn-sm d-flex mb-2"></button>
        <h4 class="mb-4"><bdo dir="rtl">دڵنیای لە چوونە دەرەوە ؟</bdo></h4>
        <div class="btns">
            <button class="btn rounded rounded-4" id="no"><bdo dir="rtl">نەخێر</bdo></button>
            <button class="btn btn-primary rounded rounded-4 ms-2" id="yes"><bdo dir="rtl">بەڵێ</bdo></button>
        </div>
    </div>
</div>
    <?php
    include("./layout/navbar.php");
    include("./php/conf.php");
    ?>
    <div class="posts px-4 py-2">
        <?php
        $posts = $conn->query("select * from posts");

        while ($row = $posts->fetch_assoc()) {
            $id = $row['user_id'];
            $users = $conn->query("select * from users where id = '$id'");
            $users_row = $users->fetch_assoc();
        ?>
            <div class="card mb-2 border-0">
                <a href="#" class="post-image">
                <img src="<?= 'images/' .  $row['image'] ?>" alt="<?= $users_row['username'] ?>" class="rounded rounded-4 w-100">
                </a>

                <p class="card-title ms-2 mt-2"><?= $row['title'] ?></p>
                <a href="<?= 'profile.php?id='.$users_row['id'] ?>" class="d-flex align-items-center text-decoration-none text-black px-2 user">
                <div class="user-img">
                <img src="<?= 'images/' . $users_row['image'] ?>" width="100%" class="rounded-circle">
                </div>
                <span class="ms-2 username"><?= $users_row['username'] ?></span>
                </a>
            </div>

        <?php } ?>
    </div>
    <script src="js/home.js"></script>
</body>

</html>