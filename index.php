<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./layout/head.php") ?>
    <title>Document</title>
</head>

<body>
    <div class="container-fluid p-0 w-100">
        <section class="h-100 bg-light">
            <nav class="navbar py-3">
                <div class="d-flex px-4  justify-content-between w-100" dir="ltr">
                    <a href="#" class="navbar-brand"><img src="svg/icon.svg" alt="icon" width="50px"></a>
                    <div class="d-flex  align-items-center">
                        <nav class="links me-5">
                            <ul class="d-flex m-0 p-0 list-unstyled">
                                <li class="mx-2"><a href="#" class="text-decoration-none"><bdo dir="rtl">دەربارە</bdo> </a></li>
                                <li class="mx-2"><a href="#" class="text-decoration-none"><bdo dir="rtl">بلۆگ</bdo> </a></li>
                                <li class="mx-2"><a href="#" class="text-decoration-none"><bdo dir="rtl">بزنس</bdo> </a></li>
                            </ul>
                        </nav>
                        <form class="d-flex">
                            <button class="btn btn-sm rounded rounded-5 border-0 p-2 px-3" id="loginBtn"><bdo dir="rtl">چونە ژورەوە</bdo></button>
                            <button class="btn btn-sm btn-secondary ms-2 rounded rounded-5 border-0 text-black p-2 px-3" id="signupBtn"><bdo dir="rtl">خۆت تۆمار بکە</bdo></button>
                        </form>
                    </div>

                </div>
            </nav>
            <div class="slogan d-flex justify-content-center flex-column align-items-center">
                <div class="mb-4 text-center slogan-container">
                    <h1 class="slogan"><bdo dir="rtl">لێرەوە دەست پێ بکە</bdo> </h1>
                    <h2 class="changing_text">changing slogan</h2>
                </div>
                <div class="dots d-flex">
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
                <span class="p-0 mx-auto"><i class="fa-solid fa-caret-down"></i> <bdo dir="rtl">زیاتر ببینە</bdo></span>
            </footer>
            <div class="image-container d-flex justify-content-between px-3">
                <div class="left d-flex align-items-center">
                    <div class="image d-flex align-items-center">
                        <img class="rounded rounded-5" src="https://i.pinimg.com/564x/d5/9c/b4/d59cb415c063a38833a6be6b3d324e11.jpg" alt="">
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
        <section class="h-100 bg-primary"></section>
        <section class="h-100 bg-success"></section>
    </div>
    <?php include("./layout/links.php") ?>
    
</body>

</html>