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
    $(".liked").show();
    $(".created").hide();
});
$("#created").click(() => {
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