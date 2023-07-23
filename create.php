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
    ?>
    <title>Home</title>
</head>

<body>
    <?php include("./layout/logoutForm.php"); ?>
    <?php include("./layout/navbar.php") ?>
    <?php
    $session_id = $_SESSION['user_id'];
    $image = $title = $tags =  $description = "";
    $user_id =  $conn->query("select id from users where session_id = '$session_id'")->fetch_column();
    if (isset($_POST['submit'])) {
        $image_name = time() . $_FILES['image']['name'];
        $image_tmpname = $_FILES['image']['tmp_name'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $tags = $_POST['tags'];
        if (move_uploaded_file($image_tmpname, 'images/uploads/' . $image_name)) {
            $conn->query("insert into posts(user_id, image, title,description, tags) values('$user_id', '$image_name' ,'$title', '$description','$tags')");
        }
    }
    ?>
    <div class="container p-5">
        <form action="<?= $_SERVER['PHP_SELF']  ?>" method="post" enctype="multipart/form-data" class="row">
            <div class="col-6">
                <div class="form-group mb-3">
                    <label for="image">
                        <div class="card border p-5">Image</div>
                    </label>
                    <input type="file" name="image" id="image" style="display: none;" accept="image/png, image/jpg, image/jpeg, image/gif">
                </div>
                <div class="form-group mb-2">
                    <label for="title">Title</label>
                    <input type="text" placeholder="title" name="title" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label for="descriprion">Description</label>
                    <textarea type="text" placeholder="description" name="description" class="form-control"></textarea>
                </div>
                <div class="form-group mb-2">
                    <label for="tags">Tags</label>
                    <input type="text" placeholder="tags" name="tags" class="form-control">
                </div>
                <div class="form-group mb-1">
                    <button class="btn btn-sm btn-primary " id="create" name="submit">post</button>
                </div>
        </form>
    </div>
    </div>
    <script src="js/home.js"></script>
</body>

</html>