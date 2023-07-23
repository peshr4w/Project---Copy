<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:index.php');
}
?>
<html lang="en">

<head>
    <?php include("./layout/head.php") ?>
    <?php include("./php/conf.php") ?>
    <?php
    $publisher_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $id = $_GET['id'];
    $profile = $conn->query("select * from users where id = '$id'");
    $row = $profile->fetch_assoc();

    ?>
    <title><?= $row['username'] ?></title>
</head>

<body>
    <?php include("./layout/logoutForm.php"); ?>
    <?php include("./layout/navbar.php") ?>

    <div class="deletePost position-fixed top-0 left-0 w-100 h-100">
        <div class="delete-form rounded bg-white rounded-4 text-center p-3 shadow mx-auto w-25 ">
            <button class="close ms-auto btn-close btn-sm d-flex mb-2"></button>
            <h4 class="mb-4"><bdo dir="rtl">پۆستی <bdo dir="rtl" id="postId">2</bdo> دەسڕیتەوە؟</bdo></h4>
            <div class="btns">
                <button class="btn rounded rounded-4" id="cancelDelete"><bdo dir="rtl">نەخێر</bdo></button>
                <button class="btn btn-primary rounded rounded-4 ms-2" id="deletePost"><bdo dir="rtl">بەڵێ</bdo></button>
            </div>
        </div>
    </div>

    <div class="container profile-page">
        <div class="row  mt-3 p-5">
            <div class=" d-flex justify-content-center flex-column align-items-center mt-4">
                <div class="image mb-4">
                    <img src="<?= 'images/users/' . $row['image'] ?>" alt="<?= $row['username'] ?>" class="w-100">
                </div>
                <div class="details text-center">
                    <h4 class="username"><strong> <?= $row['username'] ?></strong></h5>
                        <small class="username text-secondary"><?= $row['email'] ?></small>
                </div>
                <p class="mt-2 mb-2">This is a bio text</p>
                <div class="follow d-flex mb-3">
                    <button class="btn d-flex"><bdo dir="rtl">فۆڵۆو</bdo><span class="ms-1">20</span></button>
                    <button class="btn d-flex"> <bdo dir="rtl">فۆڵۆوەر</bdo>
                        <span class="ms-1" id="followerCount">
                            <?php
                            $uid = $conn->query("select id from users where session_id = '$user_id'")->fetch_column();
                            $followCount = $conn->query("select count(*) from followers where user_id = 16 ")->fetch_column();
                            echo ($followCount);
                            ?>
                        </span>
                    </button>
                </div>
                <div class="share d-flex">
                    <a href="#" class="btn rounded rounded-4 ms-2" id="share"><bdo dir="rtl">بڵاوکردنەوە</bdo></a>
                    <?php if ($user_id == $row['session_id']) { ?>
                        <a href="#" class="btn d-flex rounded rounded-4 ms-2"><bdo dir="rtl">دەستکاریکردن</bdo> </a>
                    <?php } else {
                        $uuid = $row['id'];
                        $avalable = $conn->query("select * from followers where user_id = '$uuid' and follower_id = '$uid'");
                        if($avalable->num_rows> 0 ){
                            $fbc = 'unfollowBtn';
                            $fbt = "<bdo dir='rtl'> لابردن </bdo>";
                            echo($fbc);
                        }else{
                            $fbc = 'followBtn';
                            $fbt = "<bdo dir='rtl'>فۆڵۆو</bdo>";
                            echo($fbc);
                        }
                    ?>
                        <a href="#" class="btn d-flex rounded rounded-4 ms-2 <?= $fbc ?>" id="followBtn" onclick="follow(<?= $row['id'] ?>, <?= $uid ?>)">
                        <?= $fbt  ?> </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-footer bg-white py-3">
        <div class="btns text-center">
            <button class="btn bg" id="liked"><bdo dir="rtl">بەدڵ بوو</bdo></button>
            <button class="btn" id="created"><bdo dir="rtl">پۆستەکان</bdo></button>
        </div>
    </div>
    <div class="profile-footer-content position-relative ">
        <div class="liked liked-posts position-absolute show p-4   w-100 posts">
            <?php
            $userId = $conn->query("select id from users where id = '$publisher_id'")->fetch_column();
            $likes = $conn->query("select * from likes where user_id = '$userId'");
            if ($likes->num_rows > 0) {
                while ($row1 = $likes->fetch_assoc()) {
                    $id = $row1['user_id'];
                    $post_id = $row1['post_id'];
                    $post = $conn->query("select * from posts where id = '$post_id'")->fetch_assoc();
                    $author = $post['user_id'];
                    $users_row = $conn->query("select * from users where id = '$author'")->fetch_assoc();
            ?>
                    <div class="card mb-4 border-0  position-relative d-flex ">
                        <div class="layer position-absolute  rounded-4 p-3 opacity-0 align-self-end">
                            <div class="">
                                <?php
                                $pid = $post['id'];
                                $likes1 = $conn->query("select post_id from likes where user_id = '$userId' and post_id = '$pid' ");
                                if ($likes1->num_rows > 0) {
                                    $class = "bi-heart-fill";
                                } else {
                                    $class = "bi-heart";
                                }
                                ?>
                                <button class="btn border-0 rounded-4 likePost me-1" value="<?= $post['id'] ?>"><i class="bi  <?= $class ?>"></i></button>
                                <a href="<?= 'images/' .  $post['image'] ?>" download class="btn border-0 rounded-4 me-1"><i class="bi bi-download"></i></a>
                                <button class="btn border-0 rounded-4  sharePost mt-1" onclick="sharePost(<?= $post['id'] ?>)"><i class="bi bi-share-fill"></i></button>
                            </div>
                        </div>
                        <a href="<?= 'post.php?id=' . $post['id'] ?>" class="post-image position-relative">
                            <div class="layer position-absolute  rounded-4 p-3 w-100 h-100 opacity-0">

                            </div>
                            <img src="<?= 'images/' .  $post['image'] ?>" alt="<?= $users_row['username'] ?>" class="rounded rounded-4 w-100">
                        </a>
                        <p class="card-title ms-2 mt-2"><?= $post['title'] ?></p>
                        <a href="<?= 'profile.php?id=' . $users_row['id'] ?>" class="d-flex align-items-center text-decoration-none text-black px-2 user">
                            <div class="user-img">
                                <img src="<?= 'images/' . $users_row['image'] ?>" width="100%" class="rounded-circle">
                            </div>
                            <span class="ms-2 username"><?= $users_row['username'] ?></span>
                        </a>
                    </div>
                <?php }
            } else { ?>
                <div class="p-2 d-flex m-2 noposts text-center text-secondary text-sm"><bdo dir="rtl">هیچ پۆستێک لەبەردەستدا نییە</bdo></div>
            <?php
            } ?>
        </div>
        <div class="created position-absolute  p-4 hide  w-100 posts created-posts ">
            <?php
            $createdPost = $conn->query("select * from posts where user_id = '$userId'");
            if ($createdPost->num_rows > 0) {
                while ($row2 = $createdPost->fetch_assoc()) { ?>
                    <div class="card mb-2 border-0  position-relative d-flex">
                        <div class="layer position-absolute  rounded-4 p-3 w-100 h-100 opacity-0 align-self-end">
                            <div class="d-flex justify-content-end">
                                <?php if ($user_id == $row['session_id']) { ?>
                                    <a class="btn border-0 rounded-4 ms-1 " onclick="deletePost(<?= $row2['id'] ?>, this.parentElement)" value="<?= $row2['id'] ?>"><i class="bi bi-trash3"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                        <a href="<?= 'post.php?id=' . $row2['id'] ?>" class="post-image position-relative ">
                            <img src="<?= 'images/uploads/' .  $row2['image'] ?>" alt="<?= $users_row['username'] ?>" class="rounded rounded-4 w-100">
                        </a>
                        <small class="text-seconadry p-1"><?= $row2['created'] ?></small>
                        <p class="card-title ms-2 mt-2">
                            <?= $row2['title'] ?> <br>
                            <?= $row2['description'] ?></p>
                        </p>
                    </div>
                <?php  }
            } else { ?>
                <div class="p-2 d-flex m-2 noposts text-center text-secondary text-sm"><bdo dir="rtl">هیچ پۆستێک لەبەردەستدا نییە</bdo></div>
            <?php } ?>
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