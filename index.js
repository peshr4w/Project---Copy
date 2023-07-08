let texts = ['دیزاینی جل و بەرگ', 'دیزاینی ماڵەوە', 'بیرۆکەی فۆتۆگرافی', 'گەلەری کەسی', 'تۆڕی کۆمەڵایەتی'];
let i = 0;
let dot = $('.dots .dot');
const animator = setInterval(() => {
    if (i == texts.length) {
        i = 0
    }
    $(".changing_text").html(texts[i])
    for (let j = 0; j < dot.length; j++) {
        $(dot[j]).css("opacity", "0.5")
    }
    $(dot[i]).css("opacity", "1")
    i++
}, 3000)

function random() {
    let rand = Math.floor(Math.random() * texts.length);
    $(".changing_text").html(texts[rand])
    for (let j = 0; j < dot.length; j++) {
        $(dot[j]).css("opacity", "0.5")
    }
    $(dot[i]).css("opacity", "1")
}
random()
$.each(dot, function(l) {
    let d = $(this)
    $(d).click(function() {
        $(".changing_text").html(texts[i])
        for (let j = 0; j < dot.length; j++) {
            $(dot[j]).css("opacity", "0.5")
        }
        $(dot[l]).css("opacity", "1")
        i = l + 1
    })
})
let images = $(".image")
const animateImage = setInterval(() => {
    let rand = Math.floor(Math.random() * images.length);
    for (let i = 0; i < images.length; i++) {
        $(images[i]).css({
            opacity: 0.7,
            transform: 'scale(1)'
        })
    }
    $(images[rand]).css({
        opacity: 1,
        transform: 'scale(1.1)'
    })
}, 5000)