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
<input type="hidden" id="userID" value="<?= $publisher_id ?>">

<body>
    <?php include("./layout/logoutForm.php"); ?>
    <?php include("./layout/navbar.php") ?>

    <div class="deletePost position-fixed top-0 left-0 w-100 h-100">
        <div class="delete-form rounded bg-white rounded-4 text-center p-3 shadow mx-auto w-25 ">
            <button class="close ms-auto btn-close btn-sm d-flex mb-2"></button>
            <h4 class="mb-4"><bdo dir="rtl">پۆستی <bdo dir="rtl" id="postId">2</bdo> دەسڕیتەوە؟</bdo></h4>
            <div class="btns">
                <button class="btn rounded rounded-4 deletePostBtn" id="cancelDelete"><bdo dir="rtl">نەخێر</bdo></button>
                <button class="btn btn-primary rounded rounded-4 ms-2 " id="deletePost"><bdo dir="rtl">بەڵێ</bdo></button>
            </div>
        </div>
    </div>
    <div class="add-bio position-fixed top-0 left-0 w-100 h-100">
        <div class="add-bio-form rounded bg-white rounded-4 text-center p-3 shadow mx-auto w-25 ">
            <button class="close ms-auto btn-close btn-sm d-flex mb-2"></button>
            <p class="mb-4"><bdo dir="rtl">نوێکردنەوەی بایۆ</bdo></p>
            <div class="form-group position-relative">
                <label for="bioInput">
                    <span class="text-secondary blc">
                        <small id="bioLength">0</small><small>&bsol;80 </small>
                    </span>
                </label>
                <input type="text" placeholder="شتێک بنوسە" id="bioInput" class="form-control rounded-4" maxlength="80" autocomplete="off">
                <div class="btns pt-3 d-flex justify-content-end">
                    <button class="btn btn-sm me-1 rounded-4 close"><bdo dir="rtl">لابردن</bdo></button>
                    <button class="btn btn-sm rounded-4" id="updateBioBtn"><bdo dir="rtl">نوێکردنەوە</bdo></button>
                </div>
            </div>
        </div>
    </div>
    <div class="follow-list position-fixed top-0 left-0 w-100 h-100">
        <div class="follow-list-container rounded bg-white rounded-4 text-center  shadow mx-auto w-25 " style="overflow: hidden;">
            <div class="d-flex p-3 pb-2 ">
                <span><bdo dir="rtl">فۆڵۆوەرەکان</bdo></span>
                <button class="close ms-auto btn-close btn-sm d-flex mb-2"></button>
            </div>
            <div class="users-list p-3">
                <?php
                $fID = $row['id'];
                $followers = $conn->query("select * from followers where user_id = '$fID'");
                if ($followers->num_rows  > 0) {
                    while ($FFA = $followers->fetch_assoc()) {
                        $FAID = $FFA['follower_id'];
                        $followerAcc = $conn->query("select * from users where id = '$FAID'");
                        while ($FAID_row = $followerAcc->fetch_assoc()) { ?>
                            <div class="follower_acc d-flex rounded-4 p-1 mb-1">
                                <a href="<?= 'profile.php?id=' . $FAID_row['id'] ?>" class="d-flex align-items-center text-decoration-none w-100 ">
                                    <div class="image border">
                                        <img src="<?= './images/users/' . $FAID_row['image'] ?>" alt="<?= $FAID_row['username'] ?>" class="w-100">
                                    </div>
                                    <div class="detail ms-2 d-flex align-items-start justify-content-start flex-column">
                                        <div class="m-0 p-0 text-black"><?= $FAID_row['username']  ?></div>
                                        <div class="m-0 p-0" style="font-size: 0.8em;"><small class="text-secondary"> <?= $FAID_row['email']  ?></small></div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    <?php }
                } else { ?>
                    <p><bdo dir="rtl">بەکارهێنەر هیچ فۆڵۆوەرێکی نییە</bdo></p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="following-list position-fixed top-0 left-0 w-100 h-100">
        <div class="follow-list-container rounded bg-white rounded-4 text-center  shadow mx-auto w-25 "  style="overflow: hidden;">
            <div class="d-flex p-3 pb-2 ">
                <span><bdo dir="rtl">فۆڵۆو کراوەکان</bdo></span>
                <button class="close ms-auto btn-close btn-sm d-flex mb-2"></button>
            </div>
            <div class="users-list p-3">
                <?php
                $fID1 = $row['id'];
                $following = $conn->query("select * from followers where follower_id = '$fID'");
                if ($following->num_rows  > 0) {
                    while ($FFA1 = $following->fetch_assoc()) {
                        $FAID1 = $FFA1['user_id'];
                        $followingAcc = $conn->query("select * from users where id = '$FAID1'");
                        while ($FAID_row1 = $followingAcc->fetch_assoc()) { ?>
                            <div class="follower_acc d-flex rounded-4 p-1 mb-1">
                                <a href="<?= 'profile.php?id=' . $FAID_row1['id'] ?>" class="d-flex align-items-center text-decoration-none w-100 ">
                                    <div class="image border">
                                        <img src="<?= './images/users/' . $FAID_row1['image'] ?>" alt="<?= $FAID_row1['username'] ?>" class="w-100">
                                    </div>
                                    <div class="detail ms-2 d-flex align-items-start justify-content-start flex-column">
                                        <div class="m-0 p-0 text-black"><?= $FAID_row1['username']  ?></div>
                                        <div class="m-0 p-0" style="font-size: 0.8em;"><small class="text-secondary"> <?= $FAID_row1['email']  ?></small></div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    <?php }
                } else { ?>
                    <p><bdo dir="rtl">هیچ ئەکاونتێک فۆڵۆو نەکراوە</bdo></p>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
    <div class="fireworks position-absolute w-100 h-100 top-0">
    </div>
    <div class="container profile-page">
        <div class="row  mt-3 p-5">
            <div class=" d-flex justify-content-center flex-column align-items-center mt-4 position-relative">
                <?php
                if (isset($_GET['msg'])) {
                    $msg = $_GET['msg']; ?>
                    <p class="an updateMsg p-2 rounded-4 text-success position-absolute"><small> <?= $msg ?></small></p>
                <?php } ?>
                <div class="image mb-2 position-relative">
                    <img src="<?= 'images/users/' . $row['image'] ?>" alt="<?= $row['username'] ?>" class="w-100">
                </div>
                <?php if ($user_id == $row['session_id']) { ?>
                    <form id="updateImage" action="php/updateImage.php" enctype="multipart/form-data" method="post" class="poition-absolute">
                        <label for="profileImage" class="text-secondary" id="updatePfp"><small><bdo dir="rtl" class="me-1">گۆڕینی وێنەی پڕۆفایل</bdo></small><i class="bi bi-image"></i></label>
                        <input type="file" name="profileImage" id="profileImage" accept="image/png, image/jpg, image/jpeg, image/gif" class="d-none">
                    </form>
                <?php } ?>
                <div class="details text-center mt-2">
                    <h4 class="username">
                        <strong> <?= $row['username'] ?></strong>
                        <?php
                        $is_verified =  $row['verified'];
                        if ($is_verified == "1") { ?>
                          <small>  <i class="bi bi-patch-check-fill ms-auto" style="color: dodgerblue;"></i></small>
                        <?php } ?>
                    </h4>
                    <small class="username text-secondary"><?= $row['email'] ?></small>
                </div>
                <?php
                $userBiId = $row['id'];
                $bio = $conn->query("select bio from users where id = '$userBiId'")->fetch_column();
                if ($bio == "null") {
                    $bioTxt = "<bdo dir='rtl'>هێشتا هیچ بایۆیەک نییە</bdo>";
                } else {
                    $bioTxt = $bio;
                }
                ?>
                <?php
                if ($user_id == $row['session_id']) {
                    $dic = 'd-block';
                } else {
                    $dic = 'd-none';
                }
                ?>
                <p class="mt-2 mb-2 d-flex flex-wrap flex-column" style="font-size: 0.8em;">
                    <small class="bioTxt text-center" id="bioTxt"><?= $bioTxt ?></small>
                    <button class="btn border-0 outline-0 addBio mx-auto <?= $dic ?>" id="addBio" onclick="addBio()">
                        <bdo dir="rtl">نوێکردنەوە</bdo>
                        <i class="bi bi-plus-circle "></i></button>
                </p>
                <div class="follow d-flex mb-3">
                    <button class="btn d-flex" id="showFollowings"><bdo dir="rtl">فۆڵۆو</bdo>
                        <span class="ms-1">
                            <?php
                            $xid = $row['id'];
                            $followingCount = $conn->query("select count(*) from followers where follower_id = '$xid' ")->fetch_column();
                            echo ($followingCount);
                            ?>
                        </span>
                    </button>
                    <button class="btn d-flex" id="showFollowers"> <bdo dir="rtl">فۆڵۆوەر</bdo>
                        <span class="ms-1" id="followerCount">
                            <?php
                            $uid = $conn->query("select id from users where session_id = '$user_id'")->fetch_column();
                            $followCount = $conn->query("select count(*) from followers where user_id = '$xid' ")->fetch_column();
                            echo ($followCount);
                            ?>
                        </span>
                    </button>
                </div>
                <div class="share d-flex">
                    <a href="#" class="btn rounded rounded-4 ms-2" id="share" onclick="shareProfile(<?= $row['id'] ?>)"><bdo dir="rtl">بڵاوکردنەوە</bdo></a>
                    <?php if ($user_id == $row['session_id']) { ?>
                    <?php } else {
                        $uuid = $row['id'];
                        $avalable = $conn->query("select * from followers where user_id = '$uuid' and follower_id = '$uid'");
                        if ($avalable->num_rows > 0) {
                            $fbc = 'unfollowBtn';
                            $fbt = "<bdo dir='rtl'> لابردن </bdo>";
                        } else {
                            $fbc = 'followBtn';
                            $fbt = "<bdo dir='rtl'>فۆڵۆو</bdo>";
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
        <div class="liked liked-posts position-absolute show p-4  w-100 posts">
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
                                <a href="<?= 'images/uploads/' .  $post['image'] ?>" download class="btn border-0 rounded-4 me-1"><i class="bi bi-download"></i></a>
                                <button class="btn border-0 rounded-4  sharePost mt-1" onclick="sharePost(<?= $post['id'] ?>)"><i class="bi bi-share-fill"></i></button>
                            </div>
                        </div>
                        <a href="<?= 'post.php?id=' . $post['id'] ?>" class="post-image position-relative">
                            <div class="layer position-absolute  rounded-4 p-3 w-100 h-100 opacity-0">
                            </div>
                            <img src="<?= 'images/uploads/' .  $post['image'] ?>" alt="<?= $users_row['username'] ?>" class="rounded rounded-4 w-100">
                        </a>
                        <p class="card-title ms-2 mt-2"><?= $post['title'] ?></p>
                        <a href="<?= 'profile.php?id=' . $users_row['id'] ?>" class="d-flex align-items-center text-decoration-none text-black px-2 user">
                            <div class="user-img">
                                <img src="<?= 'images/users/' . $users_row['image'] ?>" width="100%">
                            </div>
                            <span class="ms-2 username"><?= $users_row['username'] ?></span>
                        </a>
                    </div>
                <?php }
            } else { ?>
                <div class="p-2 d-flex m-2 noposts text-center text-secondary text-sm"> <bdo dir="rtl">هیچ پۆستێک لایک نەکراوە💔</bdo></div>
            <?php
            } ?>
        </div>
        <div class="created created-posts position-absolute  p-4 hide  w-100 posts">
            <?php
            $createdPost = $conn->query("select * from posts where user_id = '$userId'");
            if ($createdPost->num_rows > 0) {
                while ($row3 = $createdPost->fetch_assoc()) { ?>
                    <div class="card mb-2 border-0  position-relative d-flex">
                        <div class="layer position-absolute  rounded-4 p-3 w-10 h-10 opacity-0 align-self-end">
                            <div class="d-flex justify-content-end">
                                <?php if ($user_id == $row['session_id']) { ?>
                                    <a class="btn border-0 rounded-4 ms-1" onclick="deletePost(<?= $row3['id'] ?>, this.parentElement)" value="<?= $row3['id'] ?>"><i class="bi bi-trash3"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                        <a href="<?= 'post.php?id=' . $row3['id'] ?>" class="post-image position-relative ">
                            <div class="layer2 position-absolute  rounded-4 p-3 w-100 h-100 opacity-0 "></div>
                            <img src="<?= './images/uploads/' .  $row3['image'] ?>" alt="" class="rounded rounded-4 w-100">
                        </a>
                        <small class="text-secondary p-2 pb-0"><?= $row3['created'] ?></small>
                        <div class="card-title ms-2 ">
                            <span><?= $row3['title'] ?> </span> <br>
                            <span class="text-secondary"> <?= $row3['description'] ?></span>
                        </div>
                    </div>
                <?php  }
            } else { ?>
                <div class="p-2 d-flex m-2 noposts text-center text-secondary text-sm"><bdo dir="rtl">هیچ پۆستێک نەکراوە</bdo></div>
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