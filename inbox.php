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

    <?php include("./php/conf.php"); ?>
    <?php include("./layout/logoutForm.php"); ?>
    <?php include("./layout/navbar.php") ?>
    <div class="container py-5">
        <div class="warnings">
            <?php
            $session_id = $_SESSION['user_id'];
            $user_id = $conn->query("select id from users where session_id = '$session_id'")->fetch_column();
            $inbox = $conn->query("select * from inbox where user_id = '$user_id'");
            if ($inbox->num_rows > 0) {
                while ($row = $inbox->fetch_assoc()) {
            ?>
                    <div class="inbox p-2 mb-3 rounded-4 border d-flex justify-content-between">
                        <button class="btn border-0 outline-0" onclick="deleteInbox(<?= $row['id'] ?>, this.parentElement)"><i class="bi bi-trash3"></i></button>
                        <div class="text-end px-2">
                            <?= $row['message'] ?> <br>
                            <small class="text-secondary" style="font-size: 12px;">
                                 <?= $row['date'] ?>
                            </small>
                        </div>
                    </div>

                <?php }
            } else { ?>
                <span class="text-center d-flex justify-content-center">
                    <i class="bi bi-inbox me-1"></i>
                    <bdo dir="rtl">هیچ ئاگادارکردنەوەیەک نییە</bdo>
                </span>
            <?php } ?>

        </div>
    </div>
    <input type="hidden" name="" value="<?= $user_id ?>" id="userId">
    <script src="js/home.js"></script>
    <script>
        $(function() {
            let id = $("#userId").val();
            $.ajax({
                type: "get",
                url: "php/seen.php",
                data: {
                    userId: id
                },
                success: function(res) {
                    if (res == "seen") {
                        $(".warning").hide();
                    }
                }
            });
        })
    </script>

</body>

</html>