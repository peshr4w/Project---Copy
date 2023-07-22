$("#search").on({
    focus: () => {
        $(".search-result").show();
    },
    blur: () => {
        $(".search-result").hide();
    },
});
$(".bars").click(() => {
    if ($(".navbar .dropdown").hasClass("hidden")) {
        $(".navbar .dropdown").addClass("display");
        $(".navbar .dropdown").removeClass("hidden");
        $(".navbar .dropdown").addClass("op");
    } else {
        $(".navbar .dropdown").removeClass("display");
        $(".navbar .dropdown").addClass("hidden");
        $(".navbar .dropdown").removeClass("op");
    }
});
$("#share").click(() => {
    if (navigator.share) {
        navigator
            .share({
                title: "Profile",
                url: "project",
                text: "project website",
            })
            .then(() => console.log("success"))
            .catch(() => console.log(error));
    }
});
$("#liked").click(() => {
    $("#liked").addClass("bg");
    $("#created").removeClass("bg");
    $(".liked").show();
    $(".created").hide();
});
$("#created").click(() => {
    $("#created").addClass("bg");
    $("#liked").removeClass("bg");
    $(".created").show();
    $(".liked").hide();
});
$("#logout").click(() => {
    $(".logout").show();
    $(".logout-form").addClass("an");
    $("#yes").click(() => {
        $.ajax({
            type: "post",
            url: "php/logout.php",
            success: function(res) {
                if (res == "out") {
                    window.location.href = "index.php";
                }
            },
        });
    });
    $("#no").click(() => {
        $(".logout").hide();
    })
});
$(".logout-form .btn-close").click(() => {
    $(".logout").hide();
});
let likeBtns = $(".likePost");
$.each(likeBtns, function(i) {
    let likeBtn = $(this)[0]

    let userId = $("#userId").val()

    $(likeBtn).click(() => {
        if ($(likeBtn).find('i').hasClass('bi-heart')) {
            let postId = $(likeBtn).val();
            $.ajax({
                type: "get",
                url: "php/likePost.php",
                data: {
                    userId: userId,
                    postId: postId
                },
                success: function(res) {
                    if (res == 'liked') {
                        $(likeBtn).find('i').removeClass('bi-heart')
                        $(likeBtn).find('i').addClass('bi-heart-fill')
                    }
                }
            });
        } else {
            let postId = $(likeBtn).val();
            $.ajax({
                type: "get",
                url: "php/unlikePost.php",
                data: {
                    userId: userId,
                    postId: postId
                },
                success: function(res) {
                    console.log(res)
                    if (res == 'unliked') {
                        $(likeBtn).find('i').removeClass('bi-heart-fill')
                        $(likeBtn).find('i').addClass('bi-heart')
                    }
                }
            });
        }
    });

});
let deleteBtns = $(".card .deleteBtn");
$.each(deleteBtns, () => {
    let deleteBtn = $(this)[0];
    $(deleteBtn).click(() => {
        console.log(deleteBtn)
        $.ajax({
            type: "get",
            url: "php/deletePost.php",
            data: { postId: post_id },
            dataType: "dataType",
            success: function(res) {
                console.log(res)
            }
        });
    });
});


function sharePost(id) {
    let url = "post.php?id=" + id;
    if (navigator.share) {
        navigator.share({
                title: "post" + id,
                url: url,
                text: "share this post"
            })
            .then(res => {

            })
            .catch(err => console.log(err))
    }
}