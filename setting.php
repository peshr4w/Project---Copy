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
    <title>Setting</title>
    <style>
        input:focus {
            border: 1px solid #2D3A3A !important;
        }

        .delete-form button {
            border: 1px solid gray;
            transition: 0.1s;
        }

        .delete-form button:hover {
            background-color: red !important;
            color: whitesmoke !important;
        }


        .delete-modal,
        .btns button:nth-child(2) {
            background-color: #2D3A3A !important;
            color: whitesmoke;
        }

        .delete-modal,
        .change-modal {
            margin-top: 100px;
            background-color: white !important;
            color: black;
        }

        @media(min-width:600px) {

            .delete-modal,
            .change-modal {
                width: 25% !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }
        }

        .alert {
            background-color: rgba(0 255 0/10%);
            color: green;
        }

        .alert2, .alert3 {
            background-color: rgba(255 0 0/10%);
            color: res;
        }

        .change:hover {
            background-color: #2D3A3A;
            color: whitesmoke;
        }
    </style>
</head>

<body class="position-relative">
    <?php
    include("./php/conf.php");
    include("./layout/logoutForm.php");
    include("./layout/navbar.php");
    ?>
    <?php
    $sid = $_SESSION['user_id'];
    $user = $conn->query("select * from users where session_id = '$sid'")->fetch_assoc();
    ?>

    <div class="alert text-center  mx-5 rounded-4 p-2 mb-0" style="display: none;">
        <bdo dir="rtl">سەرکەوتو بوو</bdo>
    </div>
    <div class="alert2 text-center  mx-5 rounded-4 p-2 mb-0" style="display: none;">
        <bdo dir="rtl">تکایە دڵنیابە ئیمەڵەکەت بەڕاستی نوسیوە</bdo>
    </div>
    <div class="alert3 text-center  mx-5 rounded-4 p-2 mb-0" style="display: none;">
    <bdo dir="rtl">پاسۆرد هەڵەیە</bdo>
    </div>
    <div id="delete-posts" class="sh delete-posts position-absolute w-100 h-100  align-items-center justify-content-center" style="display: none;">
        <div class="delete-modal mx-5 rounded-4 shadow p-3 bg-white">
            <h6 class="mb-3 text-end"><bdo dir="rtl">دەتەوێت گشت پۆستەکان بسریتەوە؟</bdo></h6>
            <div class="text-center"> <small class="code"></small></div>
            <input type="text" class="text-center confirm form-control w-50 mb-3 mx-auto rounded-4 confirm-code">
            <div class="btns text-end">
                <button class="btn p-1 border-0 outline-0 rounded-4 px-2" onclick="hideDeletePosts()"><bdo dir="rtl">نەخێر</bdo></button>
                <button class="btn p-1 border-0 outline-0 rounded-4 px-2 delete" disabled><bdo dir="rtl">بەڵێ</bdo></button>
            </div>
        </div>
    </div>
    <div id="delete-likes" class="sh delete-likes position-absolute w-100 h-100  align-items-center justify-content-center" style="display: none;">
        <div class="delete-modal mx-5 rounded-4 shadow p-3 bg-white">
            <h6 class="mb-3 text-end"><bdo dir="rtl">دەتەوێت گشت لایکەکان بسریتەوە؟</bdo></h6>
            <div class="text-center"> <small class="code"></small></div>
            <input type="text" class="text-center confirm form-control w-50 mb-3 mx-auto rounded-4 confirm-code">
            <div class="btns text-end">
                <button class="btn p-1 border-0 outline-0 rounded-4 px-2" onclick="hideDeleteLikes()"><bdo dir="rtl">نەخێر</bdo></button>
                <button class="btn p-1 border-0 outline-0 rounded-4 px-2 delete" disabled><bdo dir="rtl">بەڵێ</bdo></button>
            </div>
        </div>
    </div>
    <div id="delete-comments" class="sh delete-comments position-absolute w-100 h-100  align-items-center justify-content-center" style="display: none;">
        <div class="delete-modal mx-5 rounded-4 shadow p-3 bg-white">
            <h6 class="mb-3 text-end"><bdo dir="rtl">دەتەوێت گشت کۆمێنتەکان بسریتەوە؟</bdo></h6>
            <div class="text-center"> <small class="code"></small></div>
            <input type="text" class="text-center confirm form-control w-50 mb-3 mx-auto rounded-4 confirm-code">
            <div class="btns text-end">
                <button class="btn p-1 border-0 outline-0 rounded-4 px-2" onclick="hideDeleteComments()"><bdo dir="rtl">نەخێر</bdo></button>
                <button class="btn p-1 border-0 outline-0 rounded-4 px-2 delete" disabled><bdo dir="rtl">بەڵێ</bdo></button>
            </div>
        </div>
    </div>
    <div id="delete-account" class="sh delete-account position-absolute w-100 h-100  align-items-center justify-content-center" style="display: none;">
        <div class="delete-modal mx-5 rounded-4 shadow p-3 bg-white ">
            <h6 class="mb-3 text-end"><bdo dir="rtl">دەتەوێت ئەکاونتەکەت بسریتەوە؟</bdo></h6>
            <input type="text" class="text-center confirm form-control w-75 mb-3 mx-auto rounded-4 confirm-code" placeholder="پاسۆرد">
            <div class="btns text-end">
                <button class="btn p-1 border-0 outline-0 rounded-4 px-2" onclick="hideDeleteAccount()"><bdo dir="rtl">نەخێر</bdo></button>
                <button class="btn p-1 border-0 outline-0 rounded-4 px-2 delete" disabled><bdo dir="rtl">بەڵێ</bdo></button>
            </div>
        </div>
    </div>
    <div id="change-email" class="sh change-email position-absolute w-100 h-100  align-items-center justify-content-center" style="display: none;">
        <div class="change-modal mx-5 border rounded-4 shadow-sm p-3 bg-white ">
            <h6 class="mb-3 text-end"><bdo dir="rtl">دەتەوێت ئیمەڵەکەت بگۆڕیت؟</bdo></h6>
            <div class="text-center"> <small class="code"></small></div>
            <input type="text" class="text-center confirm form-control w-50 mb-3 mx-auto rounded-4 confirm-code">
            <div class="btns text-end">
                <button class="btn p-1 border-0 outline-0 rounded-4 px-2" onclick="hideChangeEmail()"><bdo dir="rtl">نەخێر</bdo></button>
                <button class="btn p-1 border-0 outline-0 rounded-4 px-2 change" disabled><bdo dir="rtl">بەڵێ</bdo></button>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="col-12 col-md-6">
            <form action="" id="delete-form">
                <div class="form-group mb-3 d-flex">
                    <div class="col-10">
                        <input type="text" id="email" value="<?= $user['email'] ?>" class="form-control rounded-4" autocomplete="off">
                    </div>
                    <div class="col-2">
                        <button class="btn outline-0 rounded-4 border ms-2 change" id="change-email" onclick="showChangeEmail()"><bdo dir="rtl">گۆڕین</bdo></button>
                    </div>
                </div>
                <div class="form-group delete-form">
                    <div class="col-sm-12 col-md-4">
                        <button class="btn rounded-4 p-1 px-2 mb-2" onclick="showDeletePosts()">
                            <i class="bi bi-trash3"></i>
                            <bdo dir="rtl">پۆستەکان بسڕەوە</bdo>
                        </button>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <button class="btn rounded-4 p-1 px-2 mb-2" onclick="showDeleteLikes()">
                            <i class="bi bi-trash3"></i>
                            <bdo dir="rtl">لایکەکان بسڕەوە</bdo>
                        </button>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <button class="btn rounded-4 p-1 px-2 mb-2" onclick="showDeleteComments()">
                            <i class="bi bi-trash3"></i>
                            <bdo dir="rtl">کۆمێنتەکان بسڕەوە</bdo>
                        </button>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <button class="btn rounded-4 p-1 px-2 mb-2" onclick="showDeleteAccount()">
                            <i class="bi bi-trash3"></i>
                            <bdo dir="rtl">ئەکاونتەکەت بسڕەوە</bdo>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    $session_id = $_SESSION['user_id'];
    $user_id = $conn->query("select id from users where session_id = '$session_id'")->fetch_column();
    ?>
    <input type="hidden" value="<?= $user_id ?>" id="userId">
    <script src="js/home.js"></script>
    <script>
        $("#delete-form").submit((e) => {
            e.preventDefault()
        });

        function showDeletePosts() {
            $("#delete-posts").show()
            $("#delete-posts .delete-modal").addClass('an')
            $("#delete-posts .code").html(Math.floor(Math.random() * 99999));

            $("#delete-posts .confirm-code").keyup(() => {
                if ($("#delete-posts .confirm-code").val() == $("#delete-posts .code").html()) {
                    $("#delete-posts .delete").removeAttr('disabled');
                    $("#delete-posts .delete").click(() => {
                        $.ajax({
                            type: "POST",
                            url: "php/deleteAllPosts.php",
                            success: function(res) {
                                if (res == "deleted") {
                                    $("#delete-posts").hide()
                                    $(".alert").show();
                                    $("#delete-posts .confirm-code").val("")
                                    setTimeout(() => {
                                        $(".alert").hide();
                                    }, 3000)
                                }
                            }
                        });
                    });
                } else {
                    $("#delete-posts .delete").attr('disabled', true);
                }
            });
        }

        function hideDeletePosts() {
            $("#delete-posts").hide();
        }

        function showDeleteLikes() {
            $("#delete-likes").show();
            $("#delete-likes .delete-modal").addClass('an');
            $("#delete-likes .code").html(Math.floor(Math.random() * 99999));

            $("#delete-likes .confirm-code").keyup(() => {
                if ($("#delete-likes .confirm-code").val() == $("#delete-likes .code").html()) {
                    $("#delete-likes .delete").removeAttr('disabled');
                    $("#delete-likes .delete").unbind('click').bind('click', () => {
                        $.ajax({
                            type: "POST",
                            url: "php/deleteAllLikes.php",
                            success: function(res) {
                                if (res == "deleted") {
                                    $("#delete-likes").hide();
                                    $(".alert").show();
                                    $("#delete-likes .confirm-code").val("");
                                    setTimeout(() => {
                                        $(".alert").hide();
                                    }, 3000)
                                }
                            }
                        });
                    });
                } else {
                    $("#delete-likes .delete").attr('disabled', true);
                }
            });
        }

        function hideDeleteLikes() {
            $("#delete-likes").hide();
        }

        function showDeleteComments() {
            $("#delete-comments").show();
            $("#delete-comments .delete-modal").addClass('an');
            $("#delete-comments .code").html(Math.floor(Math.random() * 99999));

            $("#delete-comments .confirm-code").keyup(() => {
                if ($("#delete-comments .confirm-code").val() == $("#delete-comments .code").html()) {
                    $("#delete-comments .delete").removeAttr('disabled');
                    $("#delete-comments .delete").unbind('click').bind('click', () => {
                        $.ajax({
                            type: "POST",
                            url: "php/deleteAllComments.php",
                            success: function(res) {
                                if (res == "deleted") {
                                    $("#delete-comments").hide();
                                    $(".alert").show();
                                    $("#delete-comments .confirm-code").val("");
                                    setTimeout(() => {
                                        $(".alert").hide();
                                    }, 3000)
                                }
                            }
                        });
                    })
                } else {
                    $("#delete-comments .delete").attr('disabled', true);
                }
            });
        }

        function hideDeleteComments() {
            $("#delete-comments").hide();
        }

        function showDeleteAccount() {
            $("#delete-account").show();
            $("#delete-account .delete-modal").addClass('an');
            $("#delete-account .code").html(Math.floor(Math.random() * 99999999));

            $("#delete-account .confirm-code").keyup(() => {
                
                if ($("#delete-account .confirm-code").val() != "") {
                    $("#delete-account .delete").removeAttr('disabled');
                    let pass = $("#delete-account .confirm-code").val();
                    $("#delete-account .delete").unbind('click').bind('click', () => {
                        $.ajax({
                            type: "POST",
                            url: "php/deleteAccount.php",
                            data:{pass: pass},
                            success: function(res) {
                                if (res == "deleted") {
                                    $("#delete-account").hide();
                                    $(".alert").show();
                                    $("#delete-account .confirm-code").val("")
                                    setTimeout(() => {
                                        $(".alert").hide();
                                        location.reload()
                                    }, 3000)
                                }else{
                                    $("#delete-acc").hide();
                                    $(".alert3").show();
                                    $("#delete-acc .confirm-code").val("");
                                    setTimeout(() => {
                                        $(".alert3").hide();
                                    }, 3000)        
                                }
                            }
                        });
                    });
                } else {
                    $("#delete-account .delete").attr('disabled', true)
                }
            })
        }

        function hideDeleteAccount() {
            $("#delete-account").hide();
        }

        function showChangeEmail() {
            $("#change-email").show();
            $("#change-email .change-modal").addClass('an');
            $("#change-email .code").html(Math.floor(Math.random() * 99999));
            let new_email = $("#email").val();

            $("#change-email .confirm-code").keyup(() => {
                if ($("#change-email .confirm-code").val() == $("#change-email .code").html()) {
                    $("#change-email .change").removeAttr('disabled');
                    $("#change-email .change").unbind('click').bind('click', () => {
                        $.ajax({
                            type: "POST",
                            url: "php/changeEmail.php",
                            data: {
                                email: new_email
                            },
                            success: function(res) {
                                if (res == "changed") {
                                    $("#change-email").hide();
                                    $(".alert").show();
                                    $("#change-email .confirm-code").val("")
                                    setTimeout(() => {
                                        $(".alert").hide();
                                    }, 3000)
                                } else {
                                    $("#change-email").hide();
                                    $(".alert2").show();
                                    $("#change-email .confirm-code").val("")
                                    setTimeout(() => {
                                        $(".alert2").hide();
                                    }, 3000)
                                }
                            }
                        });
                    });
                } else {
                    $("#change-email .change").attr('disabled', true);
                }
            });
        }

        function hideChangeEmail() {
            $("#change-email").hide();
        }
    </script>
</body>

</html>