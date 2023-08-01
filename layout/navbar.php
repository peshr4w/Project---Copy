<?php
$user_id = $_SESSION['user_id'];
include('./php/conf.php');
$profile = $conn->query("select * from users where session_id = '$user_id'");
$row1 = $profile->fetch_assoc();
?>
<div class="navbar  bg-white px-4 py-3">
    <div class="brand col-2 d-flex">
        <a href="home.php" class="brand  text-decoration-none text-black" id="iconc">
            <img src="" alt="icon" width="100%" id="icon">
        </a>
    </div>
    <form class="search col-8 position-relative" action="searchResult.php" method="get">
        <i class="position-absolute fa-solid fa-search"></i>
        <input type="text" placeholder="گەڕان" id="search" name="key" autocomplete="off" class="form-control rounded rounded-5 py-2 ps-5 ">
    </form>
    <div class="profile col-2 d-flex align-items-center justify-content-evenly">
        <a href="create.php" class="create">
            <button class="btn btn-sm rounded rounded-4 border-none outline-none"><bdo dir="rtl">پۆست</bdo></button>
        </a>
        <div class="account border">
            <a href="<?= 'profile.php?id=' . $row1['id'] ?>">
                <img src="<?= 'images/users/' . $row1['image'] ?>" alt="<?= $row1['username'] ?>" class="w-100">
            </a>
        </div>
        <div class="menu position-relative">
            <a class="btn rounded rounded-5 p-0 m-0 border-0"><i class="bi bi-three-dots bars"></i></a>
        </div>
    </div>
    <div class="dropdown hidden position-absolute border p-3 bg-white rounded rounded-4">
        <div class="profile d-flex align-items-center rounded rounded-4 p-1">
            <div class="image">
                <img src="<?= 'images/users/' . $row1['image'] ?>" alt="<?= $row1['username'] ?>" class="w-100">
            </div>
            <div class="details ms-2 d-flex flex-column">
                <span> <?= $row1['username'] ?></span>
                <span><?= $row1['email'] ?></span>
            </div>
            <?php
            $uid = $row1['id'];
            $is_verified = $row1['verified'];
            if ($is_verified == "1") { ?>
                <i class="bi bi-patch-check-fill ms-auto" style="color: dodgerblue;"></i>
            <?php } else { ?>
                <i class="bi bi-check ms-auto  "></i>
            <?php } ?>

        </div>
        <a href="home.php" class="btn  p-2 border rounded rounded-4 mt-3 ms-1">
            <i class="bi bi-house me-1"></i><bdo dir="rtl">ماڵەوە</bdo>
        </a>
        <a href="<?= 'profile.php?id=' . $row1['id'] ?>" class="btn settings p-2 border rounded rounded-4 mt-3 ms-1">
            <i class="bi bi-person-fill me-1"></i><bdo dir="rtl">پرۆفایل</bdo>
        </a>
        <a href="create.php" class="btn  p-2 border rounded rounded-4 mt-3 ms-1">
            <i class="fa-regular fa-square-plus me-1"></i>پۆست<bdo dir="rtl"></bdo>
        </a>
        <a href="setting.php" class="btn  p-2 border rounded rounded-4 mt-3 ms-1">
            <i class="bi bi-gear-wide me-1"></i> <bdo dir="rtl">ڕێکخستن</bdo>
        </a>
        <a href="inbox.php" onclick="removeInboxIcon(<?= $row1['id'] ?>)" class="btn  p-2 border rounded rounded-4 mt-3 ms-1 position-relative">
            <i class="bi bi-bell me-1"></i><bdo dir="rtl"><bdo dir="rtl">ئاگادار کردنەوە</bdo></bdo>
            <?php
            $inbox = $conn->query("select inbox from users where id = '$uid'")->fetch_column();
            if ($inbox == "1") { ?>
                <span class="position-absolute rounded-circle warning" style="width:15px;height: 15px;"></span>
            <?php } ?>
        </a>
        <a href="#" class="btn  p-2 border rounded rounded-4 mt-3 ms-1" id="logout">
            <i class="bi bi-box-arrow-right me-1"></i><bdo dir="rtl">چوونە دەرەوە</bdo>
        </a>

    </div>
</div>
<div class="search-result bg-white shadow  rounded rounded-4 p-2 border w-75 ms-auto me-auto " id="search-result">

</div>