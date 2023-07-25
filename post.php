<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location:index.php');
}
?>
<html lang="en">

<head>
    <?php
    include("./layout/head.php");
    include("./php/conf.php");
    $user_id = $_SESSION['user_id'];
    $id = $_GET['id'];
    $post = $conn->query("select * from posts where id = '$id'")->fetch_assoc();
    ?>
    <title><?= 'Posts | ' . $post['title'] ?></title>
</head>

<body>
    <?php
    include("./layout/navbar.php");
    include("./layout/logoutForm.php");
    ?>
    <div class="postDetails container p-4 px-5">
        <div class="row shadow rounded-4 post-container">
            <div class="col col-12 col-md-6 p-3">
                <img src="<?= './images/uploads/' . $post['image'] ?>" alt="<?= $post['title'] ?>" class="w-100 rounded-4">
            </div>
            <div class="col col-12 col-md-6 p-0  p-3">
                <header class="description-header">
                    <div class="layer rounded-4 pb-3 align-self-end">
                        <div class="p-2 d-flex">
                            <?php
                            $sid = $_SESSION['user_id'];
                            $pid = $post['id'];
                            $usrid = $conn->query("select id from users where session_id = '$sid' ")->fetch_column();
                            $likes = $conn->query("select post_id from likes where user_id = '$usrid' and post_id = '$pid' ");
                            if ($likes->num_rows > 0) {
                                $class = "bi-heart-fill";
                                $likedTxt = "<bdo dir='rtl'>ڵایک کراوە</bdo>";
                            } else {
                                $class = "bi-heart";
                                $likedTxt = "<bdo dir='rtl'>ڵایک نەکراوە</bdo>";
                            }
                            ?>
                            <a href="<?= './images/uploads/' .  $post['image'] ?>" title="دابەزاندن" download class="btn border-0 rounded-4 "><i class="bi bi-download"></i></a>
                            <button class="btn border-0 rounded-4  sharePost sharePostBtn mt-0 ms-2" title="بڵاوکردنەوە" onclick="sharePost(<?= $post['id'] ?>)"><i class="bi bi-share-fill"></i></button>
                            <button class="btn border-0 rounded-4 likePost ms-auto position-relative" id="likePostBtn" value="<?= $post['id'] ?>">
                                <i class="bi  <?= $class ?>"></i>
                                <small class="position-absolute like-label"><?= $likedTxt ?></small>
                            </button>

                        </div>
                    </div>
                </header>
                <div class="profile d-flex align-items-center rounded-4 p-1">
                    <?php
                    $creator_id = $post['user_id'];
                    $creator = $conn->query("select * from users where id =  '$creator_id' ")->fetch_assoc();
                    ?>
                    <a href="<?= 'profile.php?id=' . $creator['id'] ?>" class="d-flex align-items-center text-decoration-none w-100 ">
                        <div class="image">
                            <img src="<?= './images/users/' . $creator['image'] ?>" alt="<?= $creator['username'] ?>" class="w-100">
                        </div>
                        <div class="detail ms-2 d-flex align-items-start justify-content-start flex-column">
                            <div class="m-0 p-0 text-black"><?= $creator['username']  ?></div>
                            <div class="m-0 p-0" style="font-size: 0.8em;"><small class="text-secondary">
                                    <?php
                                    $cid = $creator['id'];
                                    $followCount = $conn->query("select count(*) from followers where user_id = '$cid' ")->fetch_column();
                                    echo ($followCount . " followers");
                                    ?>
                                </small></div>
                        </div>

                        <?php if ($user_id == $creator['session_id']) { ?>
                        <?php } else {
                            $uid = $conn->query("select id from users where session_id = '$user_id'")->fetch_column();
                            $uuid = $creator['id'];
                            $avalable = $conn->query("select * from followers where user_id = '$uuid' and follower_id = '$uid'");
                            if ($avalable->num_rows > 0) {
                                $fbc = 'unfollowBtn';
                                $fbt = "<bdo dir='rtl'> لابردن </bdo>";
                            } else {
                                $fbc = 'followBtn';
                                $fbt = "<bdo dir='rtl'>فۆڵۆو</bdo>";
                            }
                        ?>
                            <a href="#" class="btn rounded rounded-4 border ms-2 <?= $fbc ?>" id="followBtn" onclick="follow(<?= $uuid ?>, <?= $uid ?>)">
                                <?= $fbt  ?>
                            </a>
                        <?php } ?>

                    </a>
                </div>
                <h6 class="text-end mt-3">
                    <bdo dir="ltr" class="ms-1">
                        <span id="commentCount">
                            <?php
                            $commentCount = $conn->query("select count(*) from comments where post_id = '$pid' ")->fetch_column();
                            echo ($commentCount)
                            ?>
                        </span>
                    </bdo>
                    <bdo dir="rtl">کۆمێنت</bdo>
                </h6>
                <div class="comments mt-3">
                    <?php
                    $comments = $conn->query("select * from comments where post_id = '$pid' ");
                    if ($comments->num_rows > 0) {
                        while ($comment = $comments->fetch_assoc()) {
                            $crid = $comment['user_id'];
                            $cr = $conn->query("select * from users where id = '$crid'")->fetch_assoc();
                    ?>
                            <div class="comment profile mb-4 d-flex">
                                <div class="image">
                                    <img src="<?= './images/users/' . $cr['image'] ?>" alt="<?= $cr['username'] ?>" class="w-100">
                                </div>
                                <div class="details w-75 ms-2">
                                    <small><a href="<?= 'profile.php?id=' . $cr['id'] ?>" class="text-decoration-none text-black"> <?= $cr['username'] ?></a></small>
                                    <small class="ms-1 text-secondary"><?= $comment['comment'] ?></small> <br>
                                    <small class="text-secondary" style="font-size:12px"><?= $comment['date'] ?></small>
                                </div>
                            </div>

                        <?php }
                    } else { ?>
                    <div id="dbn">
                        <i class="bi bi-chat-right-text"></i> <bdo dir="rtl">هیچ کۆمێنتێک نەکراوە</bdo>
                        </div>
                    <?php }
                    ?>
                </div>
                <div class="comment-input row mt-4">
                    <div class="col-10 ">
                        <?php
                        $uid1 = $conn->query("select id from users where session_id = '$user_id'")->fetch_column();
                        ?>
                        <input type="text" placeholder="شتێک بنوسە" id="comment_input" maxlength="255" onkeypress="sendComment(event, this.value, <?= $post['id'] ?>, <?= $uid1 ?>)" class="form-control rounded-5 p-2">
                    </div>
                    <div class="col-2 p-0">
                        <div class="user">
                            <?php
                            $writer = $conn->query("select * from users where session_id = '$user_id'")->fetch_assoc();
                            ?>
                            <img src="<?= './images/users/' . $writer['image'] ?>" alt="<?= $writer['username'] ?>" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
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