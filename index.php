<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location:home.php');
}
?>
<html lang="en">

<head>
    <?php include("./layout/head.php") ?>
    <title>Register</title>
</head>

<body>
    <?php include('./layout/registerForm.php')  ?>
    <div class="container-fluid p-0 w-100">
        <section class="h-100 bg-light" id="section1">
            <nav class="navbar py-3">
                <div class="d-flex px-4  justify-content-between w-100" dir="ltr">
                    <a href="index.php" class="navbar-brand" id="iconc" style="overflow: hidden;"><img src="" id="icon" alt="icon" width="100%"></a>
                    <div class="d-flex  align-items-center">
                        <nav class="links me-5">
                            <ul class="d-flex m-0 p-0 list-unstyled">
                                <li class="mx-2"><a href="#" class="text-decoration-none"><bdo dir="rtl">دەربارە</bdo> </a></li>
                                <li class="mx-2"><a href="#" class="text-decoration-none"><bdo dir="rtl">بلۆگ</bdo> </a></li>
                                <li class="mx-2"><a href="#" class="text-decoration-none"><bdo dir="rtl">بزنس</bdo> </a></li>
                            </ul>
                        </nav>
                        <form class="d-flex" id="register">
                            <button class="btn btn-sm rounded rounded-5 border-0 p-2 px-3 loginBtnn" data-bs-toggle="modal" data-bs-target="#exampleModalToggle1"><bdo dir="rtl">چونە ژورەوە</bdo></button>
                            <button class="btn btn-sm btn-secondary ms-2 rounded rounded-5 border-0 text-black p-2 px-3 signupBtnn" data-bs-toggle="modal" data-bs-target="#exampleModalToggle2"><bdo dir="rtl">خۆت تۆمار بکە</bdo></button>
                        </form>
                    </div>
                </div>
            </nav>
            <div class="slogan d-flex justify-content-center flex-column align-items-center">
                <div class="mb-4 text-center slogan-container">
                    <h1 class="slogan"><bdo dir="rtl">لێرەوە دەست پێ بکە</bdo> </h1>
                    <h2 class="changing_text">changing slogan</h2>
                </div>
                <div class="dots d-flex mb-3">
                    <div class="dot mx-1 border-0"></div>
                    <div class="dot mx-1 border-0"></div>
                    <div class="dot mx-1 border-0"></div>
                    <div class="dot mx-1 border-0"></div>
                    <div class="dot mx-1 border-0"></div>
                </div>
                <div class="animator d-flex align-items-center justify-content-center mt-5">
                    <i class="fa-solid fa-caret-down"></i>
                </div>
            </div>
            <footer class="w-100 d-flex align-items-center ">
                <span class="p-0 mx-auto"><a href="#section2"> <i class="fa-solid fa-caret-down"></i> <bdo dir="rtl">زیاتر ببینە</bdo></a></span>
            </footer>
            <div class="image-container d-flex justify-content-between px-3">
                <div class="left d-flex align-items-center">
                    <div class="image d-flex align-items-center">
                        <img class="rounded rounded-5" src="https://i.pinimg.com/564x/aa/59/50/aa5950a4c6e7ec295d6dd8842543c638.jpg" alt="">
                    </div>
                    <div class="image d-flex align-items-center ms-3">
                        <img class="rounded rounded-5" src="https://i.pinimg.com/564x/77/71/38/777138fbe2169ca80112abcc983cd6c8.jpg" alt="">
                    </div>
                </div>
                <div class="right d-flex align-items-center">
                    <div class="image d-flex align-items-center">
                        <img class="rounded rounded-5" src="https://i.pinimg.com/564x/dd/73/fd/dd73fdac0d2d42aa3d2fd62ae9df86f8.jpg" alt="">
                    </div>
                    <div class="image d-flex align-items-center ms-3">
                        <img class="rounded rounded-5" src="https://i.pinimg.com/564x/82/d8/c4/82d8c462fbfece3913fde50cb5e2d99c.jpg" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section class="h-100" id="section2">
            <div class="row h-100">
                <div class="col-12 col-md-6 d-flex align-items-center">
                    <div class="container images position-relative">
                        <img src="https://i.pinimg.com/564x/30/54/10/3054108c912d49d79337b28888d06a7d.jpg" class="rounded rounded-5" alt="" width="200px">
                        <img src="https://i.pinimg.com/564x/30/22/b5/3022b5b2c0e2ec4fe17490327d2a533d.jpg" class="rounded rounded-5" alt="" width="200px">
                        <img src="https://i.pinimg.com/564x/e4/84/6a/e4846ab2b51d789193c2d6ee4e1375da.jpg" class="rounded rounded-5" alt="" width="200px">
                        <img src="https://i.pinimg.com/564x/17/01/f5/1701f50d1b60e1154c2bc4f5aa1e34d3.jpg" class="rounded rounded-5" alt="" width="200px">
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex align-items-center">
                    <div class="container position-relative">
                        <h2 class="text-center mb-3 ">بەدوای هەر شتێکدا بگەڕێ کە دەتەوێت</h1>
                            <h5 class="text-center w-75 mx-auto">لە ستایلەکانەوە دیکۆرەکانی جلوبەرگ یان ئەوانی تر یان تەنها ستایلەکانی خۆت پۆست بکە کە حەزت لێیە</h5>
                            <a href="home.php" class="btn expolore position-absolute mt-4 border-0 rounded rounded-5 pt-1 mx-2 text-center ms-auto">بگەڕێ</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="h-100" id="section3">
            <div class="row h-100">
                <div class="col col-12 col-md-6 d-flex align-items-center">
                    <div class="container position-relative">
                        <h2 class="text-center mb-3 text-white">دروستی بکە، سەیڤ بکە , بڵاوی بکەرەوە</h2>
                        <h5 class="text-center w-75 mx-auto text-white">ستایلێکی سەرسوڕهێنەر دروست بکە و بەشی بکە , یان بیرۆکە لە کەسانی تر وەربگرە</h5>
                        <a href="home.php" class="btn expolore2 position-absolute mt-4 border-0 rounded rounded-5 pt-1 mx-2 text-center ms-auto text-white">بگەڕێ</a>
                    </div>
                </div>
                <div class="col col-12 col-md-6"></div>
            </div>

        </section>
        <footer style="background-color:  #2D3A3A;" class="p-3">
            <span class="text-secondary">Created by <span style="color:lightgray">@peshraw</span> <span id="year"></span> </span>
        </footer>
    </div>

    <script>
        let year = new Date().getFullYear();
        $("#year").html(year)
    </script>
    <?php include("./layout/links.php") ?>
    <script>
        if ($(window).width() < 900) {
            $("#icon").attr("src", "./icon-sm.png");
            $("#iconc").css('width', '50px');
        } else {
            $("#icon").attr("src", "./icon.png");
            $("#iconc").css('width', '150px');
        }
        $(window).resize(() => {
            if ($(window).width() < 900) {
                $("#icon").attr("src", "./icon-sm.png");
                $("#iconc").css('width', '50px');
            } else {
                $("#icon").attr("src", "./icon.png");
                $("#iconc").css('width', '150px');
            }
        });
    </script>

</body>

</html>