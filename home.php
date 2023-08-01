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
    <title>Wenakan</title>
</head>

<body>
    <?php include("./layout/logoutForm.php"); ?>
    <?php
    include("./layout/navbar.php");
    include("./php/conf.php");
    ?>
    <div class="posts p-3 px-5 gap-4 ">
        <?php
        $posts = $conn->query("select * from posts order by created desc");

        while ($row = $posts->fetch_assoc()) {
            $id = $row['user_id'];
            $users = $conn->query("select * from users where id = '$id'");
            $users_row = $users->fetch_assoc();
        ?>
            <div class="card mb-4 border-0  position-relative d-flex ">
                <div class="layer position-absolute  rounded-4 p-3 opacity-0 align-self-end">
                    <div class="">
                        <?php 
                        $sid = $_SESSION['user_id'];
                        $pid = $row['id'];
                        $usrid = $conn->query("select id from users where session_id = '$sid' ")->fetch_column();
                        $likes = $conn->query("select post_id from likes where user_id = '$usrid' and post_id = '$pid' ");
                          if($likes->num_rows > 0){
                            $class = "bi-heart-fill";
                          }else{
                            $class = "bi-heart";
                          }
                         ?>
                        <button class="btn border-0 rounded-4 likePost me-1" value="<?= $row['id'] ?>"><i class="bi  <?= $class ?>"></i></button>
                        <a href="<?= 'images/uploads/' .  $row['image'] ?>" download class="btn border-0 rounded-4 me-1"><i class="bi bi-download"></i></a>
                        <button class="btn border-0 rounded-4  sharePost sharePostBtn" onclick="sharePost(<?= $row['id'] ?>)"><i class="bi bi-share-fill"></i></button>
                    </div>
                </div>
                <a href="<?= 'post.php?id=' . $row['id'] ?>" class="post-image position-relative">
                <div class="layer position-absolute  rounded-4 p-3 w-100 h-100 opacity-0">
                    
                </div>
                    <img src="<?= 'images/uploads/' .  $row['image'] ?>" alt="<?= $users_row['username'] ?>" class="rounded rounded-4 w-100">
                </a>
                <p class="card-title ms-2 mt-2"><?= $row['title'] ?></p>
                <a href="<?= 'profile.php?id=' . $users_row['id'] ?>" class="d-flex align-items-center text-decoration-none text-black px-2 user">
                    <div class="user-img">
                        <img src="<?= 'images/users/' . $users_row['image'] ?>" width="100%" >
                    </div>
                    <span class="ms-2 username"><?= $users_row['username'] ?></span>
                </a>
            </div>

        <?php } ?>
    </div>
     <?php 
     $session_id = $_SESSION['user_id'];
     $user_id = $conn->query("select id from users where session_id = '$session_id'")->fetch_column();
     ?>
     <input type="hidden" value="<?= $user_id ?>" id="userId">
    <script src="js/home.js"></script>
</body>

</html>