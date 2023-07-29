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
    
    <div class="switcher pt-3 d-flex justify-content-center">
        <div class="btns">
            <button class="btn bg" id="showPostsResult"><bdo dir="rtl">پۆستەکان</bdo></button>
            <button class="btn" id="showUsersResult"><bdo dir="rtl">بەکارهێنەران</bdo></button>
        </div>
    </div>
    <div class="mt-3 position-relative">
        <div class="result-layer pt-3">
            <div class="image mx-auto mt-3 d-flex align-items-center justify-content-center flex-column">
            <img src="svg/plant.svg" alt="" class="w-100"> <br>
            <small class="d-flex text-center mt-2"><bdo dir="rtl">هیچ شتێک نەدۆزرایەوە</bdo></small>
            </div>
        </div>
        <div class="posts p-3 px-5 gap-4 position-absolute show  bg-white w-100" id="postsResult">
            <?php
            $key = $_GET['key'];
            $posts = $conn->query("select * from posts");

            if ($posts->num_rows > 0) {

                while ($row = $posts->fetch_assoc()) {
                    $id = $row['user_id'];
                    $users = $conn->query("select * from users where id = '$id'");
                    $users_row = $users->fetch_assoc();
                    if ($key != "") {
                        if (stristr($row['categories'], $key) || stristr($row['title'], $key)) {
            ?>
                            <div class="card mb-4 border-0 position-relative d-flex">
                                <div class="layer position-absolute  rounded-4 p-3 opacity-0 align-self-end">
                                    <div class="">
                                        <?php
                                        $sid = $_SESSION['user_id'];
                                        $pid = $row['id'];
                                        $usrid = $conn->query("select id from users where session_id = '$sid' ")->fetch_column();
                                        $likes = $conn->query("select post_id from likes where user_id = '$usrid' and post_id = '$pid' ");
                                        if ($likes->num_rows > 0) {
                                            $class = "bi-heart-fill";
                                        } else {
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
                                        <img src="<?= 'images/users/' . $users_row['image'] ?>" width="100%">
                                    </div>
                                    <span class="ms-2 username"><?= $users_row['username'] ?></span>
                                </a>
                            </div>

            <?php }
                    }
                }
            }   ?>
        </div>
        <div class="users  position-absolute hide p-3 w-100" id="usersResult" style="height: 100vh;">
            <div class="users  users-result bg-white" style="height: 100vh;">
                <?php
                $users = $conn->query("select * from users");
                while ($row1 = $users->fetch_assoc()) {
                    if ($key != "") {
                        if (stristr($row1['username'], $key)) { ?>
                            <div class="user rounded-4 mb-2">
                                <a href="<?= 'profile.php?id=' . $row1['id'] ?>" class="d-flex p-1 rounded-4 text-black text-decoration-none align-items-center">
                                    <div class="image" style="width: 40px; height: 40px;">
                                        <img src="<?= 'images/users/' . $row1['image'] ?>" alt="" class="w-100">
                                    </div>
                                    <div class="details ms-2">
                                        <span class="m-0 p-0"><?= $row1['username'] ?></span>
                                        <?php
                                        $is_verified =  $row1['verified'];
                                        if ($is_verified == "1") { ?>
                                            <small> <i class="bi bi-patch-check-fill ms-auto" style="color: dodgerblue;"></i></small>
                                        <?php } ?>
                                        <br>
                                        <small class="text-secondary m-0 p-0" style="font-size: 12px;">
                                            <?php
                                            $uuid = $row1['id'];
                                            $followCount = $conn->query("select count(*) from followers where user_id = '$uuid' ")->fetch_column(); ?>
                                            <bdo dir="rtl"><?= $followCount ?></bdo> <bdo dir="rtl">فۆڵۆوەر</bdo>
                                            <?php
                                            ?>
                                        </small>
                                    </div>
                                </a>
                            </div>
                <?php  } else {
                        }
                    }
                } ?>
            </div>
        </div>

        <?php
        $session_id = $_SESSION['user_id'];
        $user_id = $conn->query("select id from users where session_id = '$session_id'")->fetch_column();
        ?>

        <input type="hidden" value="<?= $user_id ?>" id="userId">
        <script src="js/home.js"></script>
</body>

</html>