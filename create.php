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
    ?>
    <title>Home</title>
</head>

<body>
    <?php include("./layout/logoutForm.php"); ?>
    <?php include("./layout/navbar.php") ?>
   
    <div class="container p-5">
        <form action="php/uploadPost.php" method="post" enctype="multipart/form-data" class="row">
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