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
    <div class="container profile-page">
        <div class="row  mt-3 p-5">
            <div class=" d-flex justify-content-center flex-column align-items-center mt-4">
                <div class="image mb-4">
                    <img src="<?= 'images/' . $row['image'] ?>" alt="<?= $row['username'] ?>" class="w-100">
                </div>
                <div class="details text-center">
                    <h4 class="username"><strong> <?= $row['username'] ?></strong></h5>
                        <small class="username text-secondary"><?= $row['email'] ?></small>
                </div>
                <p class="mt-2 mb-2">This is a bio text</p>
                <div class="follow d-flex mb-3">
                    <button class="btn d-flex"><span class="me-1">20</span>Following </button>
                    <button class="btn d-flex"><span class="me-1">10</span> Followers </button>
                </div>
                <div class="share d-flex">
                    <a href="#" class="btn rounded rounded-4 ms-2" id="share">Share</a>
                    <?php if($user_id == $row['session_id']){ ?>
                    <a href="#" class="btn d-flex rounded rounded-4 ms-2">Edit profile </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-footer bg-white py-3">
        <div class="btns text-center">
            <button class="btn" id="liked">Liked</button>
            <button class="btn" id="created">Created</button>
        </div>
    </div>
    <div class="profile-footer-content position-relative container-fluid">
        <div class="liked position-absolute show p-2  row w-100">
            <div class="col p-2 mb-1 rounded rounded-4 border">card</div>
            <div class="col p-2 mb-1 rounded rounded-4 border">card</div>
            <div class="col p-2 mb-1 rounded rounded-4 border">card</div>
        </div>
        <div class="created position-absolute hide p-2 row w-100">
            <div class="col p-2 mb-1 rounded rounded-4 border">created</div>
            <div class="col p-2 mb-1 rounded rounded-4 border">created</div>
            <div class="col p-2 mb-1 rounded rounded-4 border">created</div>
        </div>
    </div>
    <script src="js/home.js"></script>
</body>

</html>