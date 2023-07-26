<?php
session_start();
include('conf.php');
$userId = $_POST['userId'];
$postId = $_POST['postId'];
$comment = cleanText($_POST['comment']);
$user_id = $_SESSION['user_id'];

function cleanText($text)
{
    $text = trim($text);
    $text = htmlspecialchars($text);
    $text = stripslashes($text);
    return $text;
}

$res = $conn->query("insert into comments(post_id , user_id, comment)  values('$postId', '$userId', '$comment')");
if ($res) {
    $last_comment = $conn->query("select * from comments where post_id = '$postId' order by date desc limit 1")->fetch_assoc();
    $lcu = $conn->query("select * from users where id = '$userId'")->fetch_assoc();
    if ($last_comment) { ?>
        <div class="comment profile mb-4 d-flex">
            <div class="image">
                <img src="<?= './images/users/' . $lcu['image'] ?>" alt="<?= $lcu['username'] ?>" class="w-100">
            </div>
            <div class="details w-75 ms-2">
                <small><a href="<?= 'profile.php?id=' . $lcu['id'] ?>" class="text-decoration-none text-black"> <?= $lcu['username'] ?> </a></small>
                <small class="ms-1 text-secondary"><?= $last_comment['comment'] ?></small> <br>
                <small class="text-secondary" style="font-size:12px">
                    <?php
                    $uid = $conn->query("select id from users where session_id = '$user_id'")->fetch_column();
                    $cmd = $last_comment['date'];
                    include("timeAgo.php");
                    ?>
                </small>
                <span class="ms-3 position-relative ">
                    <a class="btn border-0 outline-0 p-0" onclick="likeComment(<?= $uid ?>, <?= $last_comment['id'] ?> , this.parentElement)" style="transform: translateY(5px)">
                        <i class="bi bi-heart"></i>
                        <small class="text-secondary " class="likesCounter" style="font-size: 12px;">0</small>
                    </a>
                </span>
            </div>
        </div>

<?php
    }
}
?>