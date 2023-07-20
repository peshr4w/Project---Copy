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
    <?php include("./layout/logoutForm.php"); ?>
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
                <a href="<?= 'post.php?id='.$row['id'] ?>" class="post-image position-relative">
                    <div class="layer position-absolute w-100 h-100 top-0 left-0 rounded-4 p-3 opacity-0">
                        <button class="btn border-0 rounded-4"><i class="bi bi-heart-fill"></i></button>
                        <button class="btn border-0 rounded-4"><i class="bi bi-download"></i></button>
                        <button class="btn border-0 rounded-4"><i class="bi bi-share-fill"></i></button>
                    </div>
                    <img src="<?= 'images/' .  $row['image'] ?>" alt="<?= $users_row['username'] ?>" class="rounded rounded-4 w-100">
                </a>
                <p class="card-title ms-2 mt-2"><?= $row['title'] ?></p>
                <a href="<?= 'profile.php?id=' . $users_row['id'] ?>" class="d-flex align-items-center text-decoration-none text-black px-2 user">
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