<?php
include('conf.php');
$key = $_POST['key'];
$users = $conn->query("select * from users");
$posts = $conn->query("select * from posts");
?>
<small class="p-1 d-flex text-end justify-content-end"><bdo dir="rtl">بەکارهێنەران</bdo></small>
<div class="users py-3">
    <?php
    while ($row = $users->fetch_assoc()) {
        if ($key != "") {
            if (stristr($row['username'], $key)) { ?>
                <div class="user rounded-4">
                    <a href="<?= 'profile.php?id=' . $row['id'] ?>" class="d-flex p-1 rounded-4 text-black text-decoration-none align-items-center">
                        <div class="image">
                            <img src="<?= 'images/users/' . $row['image'] ?>" alt="" class="w-100">
                        </div>
                        <div class="details ms-2">
                            <div><?= $row['username'] ?></div>
                        </div>
                    </a>
                </div>
    <?php  } else {
            }
        }
    } ?>
</div>
<small class="p-1 d-flex text-end justify-content-end"><bdo dir='rtl'></bdo>پۆستەکان</small>
<div class="posts">
    <?php

    while ($row1 = $posts->fetch_assoc()) {
        if ($key != "") {
            if (stristr($row1['categories'], $key) || stristr($row1['title'], $key)) { ?>
                <div class="post rounded-4 mb-2">
                    <a href="<?= 'post.php?id=' . $row1['id'] ?>" class="d-flex  rounded-4 text-black text-decoration-none align-items-center">
                        <div class="post-image border  rounded-4">
                            <img src="<?= 'images/uploads/' . $row1['image'] ?>" alt="" class="w-100">
                        </div>
                    </a>
                </div>
    <?php  } else {
            }
        }
    } ?>
</div>