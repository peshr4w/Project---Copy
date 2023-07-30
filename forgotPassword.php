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

    <div class="alert verify-alert text-center m-3 rounded-4 ">
        
    </div>
    <div class="container d-flex justify-content-center align-items-center h-100">

        <div class="col-sm-12 col-md-6 pt-5" style="height: 100vh;">
            <h3 class="text-center"> <img src="svg/password.svg" alt="" width="40px"> <bdo dir="rtl">نوێکردنەوەی وشەی نهێنی</bdo></h3>
            <form id="resetEmail" method="post" class="align-self-end mt-5">
                <div class="form-group mb-2">
                    <input type="text" name="email" id="vei" placeholder="ئیمەیڵ" class="form-control rounded-4 verify-email-input" autocomplete="off">
                </div>
                <div class="form-group d-flex align-items-end">
                    <button class="btn ms-auto verify-email-btn p-1 rounded-4 text-white px-2 w-25" disabled>
                        <small>
                            <bdo dir="rtl">ناردن</bdo>
                            <svg class="ring ms-2" viewBox="25 25 50 50" stroke-width="5">
                                <circle cx="50" cy="50" r="20" />
                            </svg>
                        </small>

                    </button>
                </div>
                <small class="text-secondary d-flex justify-content-center mt-3">
                    <bdo dir="rtl" style="font-size: 12px;" >
                        ئیمەیڵەکەت بنوسە پاشان لینکی نوێکردنەوەی پاسوۆردت لە ڕێگەی ئیمەیڵەکەوە پێدەگات
                    </bdo>
                </small>
            </form>
        </div>
    </div>
    <script src="js/home.js"></script>

</body>

</html>