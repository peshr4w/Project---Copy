<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location:home.php');
}
?>

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reset Password</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/fd93baf7b6.js" crossorigin="anonymous"></script>
        <style>
            .ring {
                --uib-size: 20px;
                --uib-speed: 2s;
                --uib-color: white;

                height: var(--uib-size);
                width: var(--uib-size);
                vertical-align: middle;
                transform-origin: center;
                animation: rotate var(--uib-speed) linear infinite;
                display: none;
            }

            .ring circle {
                fill: none;
                stroke: var(--uib-color);
                stroke-dasharray: 1, 200;
                stroke-dashoffset: 0;
                stroke-linecap: round;
                animation: stretch calc(var(--uib-speed) * 0.75) ease-in-out infinite;
            }

            @keyframes rotate {
                100% {
                    transform: rotate(360deg);
                }
            }

            @keyframes stretch {
                0% {
                    stroke-dasharray: 1, 200;
                    stroke-dashoffset: 0;
                }

                50% {
                    stroke-dasharray: 90, 200;
                    stroke-dashoffset: -35px;
                }

                100% {
                    stroke-dashoffset: -124px;
                }
            }
        </style>
    </head>

<body class="position-relative">
    <?php
    $email = $_REQUEST['email'];
    $code = $_REQUEST['code'];
    ?>
    <input type="hidden" name="email" id="email" value="<?= $email ?>">
    <input type="hidden" name="code" id="code" value="<?= $code ?>">
    <div class="alert verify-alert text-center m-3 rounded-4 ">
    </div>
    <div class="d-flex  justify-content-center text-center">
    <a href="index.php" class="text-secondary" id="loginLink" style="display: none;"> <bdo dir="rtl" >چونەژورەوە</bdo></a>
    </div>

    <div class="container d-flex justify-content-center align-items-center h-100">
        <div class="col-sm-12 col-md-6 pt-5" style="height: 100vh;">
            <h3 class="text-center"> <img src="svg/password.svg" alt="" width="40px"> <bdo dir="rtl">گۆڕینی وشەی نهێنی</bdo></h3>
            <form id="changePassword" method="post" class="align-self-end mt-5">
                <div class="form-group mb-3">
                    <input type="text" name="password" id="password" placeholder="وشەی نهێنی" class="form-control rounded-4 change-password-input" autocomplete="off">
                </div>
                <div class="form-group mb-2">
                    <input type="text" name="repassword" id="repassword" placeholder="دوبارەکردنەوەی وشەی نهێنی" class="form-control rounded-4 change-repassword-input" autocomplete="off">
                </div>
                <div class="form-group d-flex align-items-end">
                    <button class="btn ms-auto change-password-btn p-1 rounded-4 text-white px-2 w-25" disabled>
                        <small>
                            <bdo dir="rtl" style="font-size: 12px;">نوێکردنەوە</bdo>
                            <svg class="ring ms-2" viewBox="25 25 50 50" stroke-width="5">
                                <circle cx="50" cy="50" r="20" />
                            </svg>
                        </small>

                    </button>
                </div>
                <small class="text-secondary d-flex justify-content-center mt-3">
                    <bdo dir="rtl" style="font-size: 12px;">
                    </bdo>
                </small>
            </form>
        </div>

    </div>
    <script src="js/home.js"></script>

    <script>
        $("#repassword").keyup(() => {
            if ($("#repassword").val() == "") {
                $(".change-password-btn").attr('disabled', true)
            } else {
                $(".change-password-btn").removeAttr('disabled')
            }
        })
        $("#changePassword").submit((e) => {

            e.preventDefault();
            $(".ring").css("display", "inline");
            let email = $("#email").val();
            let code = $("#code").val();
            let password = $("#password").val();
            let repassword = $("#repassword").val();
            $.ajax({
                type: "POST",
                url: "php/changePassword.php",
                data: {
                    email: email,
                    code: code,
                    password: password,
                    repassword: repassword
                },
                success: function(res) {
                    console.log(res)
                    $(".alert").html(res)
                    if (res == "success") {
                        $("#password").val("");
                        $("#repassword").val("");
                        $(".ring").css("display", "none");
                        $(".alert").removeClass("error");
                        $(".alert").addClass("success");
                        $(".alert").html("بەسەرکەوتویی پاسوۆردەکەت گۆڕدرا");
                        $(".change-password-btn").attr('disabled', true);
                        $("#loginLink").addClass('d-block');
                    } else {
                        $(".alert").removeClass("success");
                        $(".alert").addClass("error");
                        $(".ring").css("display", "none");
                    }
                }
            });
        })
    </script>

</body>

</html>