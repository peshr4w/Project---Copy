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
    <title>Post</title>
</head>

<body>
    <?php include("./layout/logoutForm.php"); ?>
    <?php include("./layout/navbar.php") ?>

    <div class="container d-flex justify-content-center pt-4">
        <form action="uploadPost.php" method="post" enctype="multipart/form-data" class="w-50 uplaod-image-form">
            <div class="form-group mb-4">
                <label for="image" class="w-100 position-relative" id="image-label">
                    <div class="card border p-5 w-100 text-center rounded-4" style="cursor: pointer;">
                        <h1><i class="bi bi-image"></i></h1>
                        <p><bdo dir="rtl">وێنەیەک هەڵبژێرە</bdo></p>
                        <div><small class="text-secondary"><i class="bi bi-exclamation-circle me-1"></i><bdo dir="rtl">وێنەکە دەبێت کەمتر بێت لە 5 مێگابایت</bdo></small></div>
                    </div>
                    <div class="position-absolute w-100 h-100 rounded-4 top-0 bg-white border" id="previewc" style="display: none;">
                        <img src="" class="w-100" id="preview">
                    </div>
                </label>
                <input type="file" name="image" id="image" style="display: none;"  onchange="loadFile(event)">
            </div>
            <div class="div" id="details" style="display: none;">
                <div class="form-group mb-3 w-75">
                    <label for="title">*<bdo dir="rtl">ناونیشان</bdo></label>
                    <input type="text" name="title" id="title" class="form-control rounded-3">
                </div>
                <div class="form-group mb-3 w-75">
                    <label for="descriprion"><bdo dir="rtl">وەسف</bdo></label>
                    <textarea type="text" name="description" id="description" class="form-control shadow-none rounded-3" style="resize: none;"></textarea>
                </div>
                <div class="form-group mb-4 w-75">
                    <label for="tags"><bdo dir="rtl">تاگەکان</bdo></label>
                    <input type="text" name="tags" id="tags" class="form-control rounded-3">
                </div>
                <div class="form-group mb-3 w-75">
                    <button class="btn btn-sm post-btn rounded-3 p-2 text-center w-100" id="create" name="submit" disabled><bdo dir="rtl">پۆست</bdo></button>
                </div>
            </div>
        </form>
    </div>
    </div>
    <script>
        imgInp = document.getElementById("image");
        previewc = document.getElementById("previewc");
        details = document.getElementById("details");
        preview = document.getElementById("preview");

        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                previewc.style.display = "block"
                details.style.display = "block"
                preview.src = URL.createObjectURL(file)
            }
        }

    </script>
    <script src="js/home.js"></script>
</body>

</html>