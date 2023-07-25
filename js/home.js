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
                        $(likeBtn).find('i').removeClass('bi-heart');
                        $(likeBtn).find('i').addClass('bi-heart-fill');
                        $(".like-label").html("ڵایک کراوە");
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
                        $(likeBtn).find('i').removeClass('bi-heart-fill');
                        $(likeBtn).find('i').addClass('bi-heart');
                        $(".like-label").html("ڵایک نەکراوە")
                    }
                }
            });
        }
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
};

function deletePost(id, el) {

    $(".deletePost").show();
    $(".delete-form").addClass("an");
    $("#postId").html(id);
    $("#deletePost").click(() => {
        $.ajax({
            type: "get",
            url: "php/deletePost.php",
            data: { postId: id },
            success: function(res) {
                $(el).parents('.card').addClass('d-none')
                $(".deletePost").hide();
            }
        });
    });
    $("#cancelDelete").click(() => {
        $(".deletePost").hide();
    })

};
$(".delete-form .btn-close").click(() => {
    $(".deletePost").hide();
});

function follow(userId, followerId) {
    if ($("#followBtn").hasClass('followBtn')) {
        $.ajax({
            type: "get",
            url: "php/follow.php",
            data: { userId: userId, followerId: followerId },
            success: function(res) {
                $("#followBtn").removeClass('followBtn');
                $("#followBtn").addClass('unfollowBtn');
                $("#followBtn").html("<bdo dir='rtl'> لابردن </bdo>");
                $("#followerCount").html(res)
            }
        });
    } else {
        $.ajax({
            type: "get",
            url: "php/unFollow.php",
            data: { userId: userId, followerId: followerId },
            success: function(res) {
                $("#followBtn").addClass('followBtn');
                $("#followBtn").removeClass('unfollowBtn');
                $("#followBtn").html("<bdo dir='rtl'>فۆڵۆو</bdo>");
                $("#followerCount").html(res)
            }
        });
    }
};
$("#profileImage").change(() => {
    $("#updateImage").trigger('submit')
});

function hideMsg() {
    setTimeout(() => {
        $(".updateMsg").hide()
    }, 5000)
}
hideMsg();

function addBio() {
    $(".add-bio").show();
    $(".add-bio-form").addClass("an");

    $("#bioInput").keyup((e) => {
        if ($("#bioInput").val().length == 80) {
            $("#bioLength").css('color', 'red');
        } else {
            $("#bioLength").css('color', 'gray');
        }
        $("#bioLength").html($("#bioInput").val().length)
    });

    $("#updateBioBtn").click(() => {
        if ($("#bioInput").val() != "") {
            let bio = $("#bioInput").val().trim();
            let user_id = $("#userId").val();

            $.ajax({
                type: "post",
                url: "php/updateBio.php",
                data: { bio: bio, userId: user_id },
                success: function(res) {
                    $("#bioTxt").html(res)
                    $(".add-bio").hide();
                    $("#bioInput").val("")
                }
            });
        }
    })
};
$(".add-bio-form .btn-close").click(() => {
    $(".add-bio").hide();
});
$(".add-bio-form .close").click(() => {
    $(".add-bio").hide();
});

function shareProfile(id) {
    console.log(id)
    if (navigator.share) {
        navigator.share({
                title: "Share this profile",
                url: `profile.php?id=${id}`,
                text: "Share this profile"
            })
            .then(res => {})
            .catch((err) => { console.log(err) })
    }
};
$("#showFollowers").click(() => {
    $(".follow-list").show();
    $(".follow-list-container").addClass("an");
});
$(".follow-list-container .btn-close").click(() => {
    $(".follow-list").hide();
});

$("#showFollowings").click(() => {
    $(".following-list").show();
    $(".following-list .follow-list-container").addClass("an");
});
$(".following-list .follow-list-container .btn-close").click(() => {
    $(".following-list").hide();
});

function sendComment(e, comment, postId, userId) {
    if (e.key == "Enter") {
        $.ajax({
            type: "POST",
            url: "php/addComment.php",
            data: { comment: comment, postId: postId, userId: userId },
            success: function(res) {
                $(".comments").append(res);
                $("#dbn").html("");
                $(".comments").animate({ scrollTop: $(document).height() }, 10);
                $("#comment_input").val("");
            }
        });
    }
}