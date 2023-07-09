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
}, 4000)

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
let images_img = $(".image img")
let image_links = [
    'https://i.pinimg.com/736x/e6/ab/47/e6ab471f2c104ab434c493a3fc394771.jpg',
    'https://i.pinimg.com/564x/13/32/15/133215b74e2f31ef4a141603a5313f60.jpg',
    'https://i.pinimg.com/736x/7c/15/71/7c157183a707d18f1fd9cc29bc7e4234.jpg',
    'https://i.pinimg.com/564x/79/3d/33/793d332c93f932edf166145e050c2239.jpg',
    'https://i.pinimg.com/564x/e8/9f/eb/e89feb14e14240483fa4d67017f9d7be.jpg',
    'https://i.pinimg.com/564x/cb/d7/65/cbd765f05d6b194f5d95748adc9557b8.jpg',
    'https://i.pinimg.com/564x/02/7a/1c/027a1c2df5fceb39e82245f63b1b1ccc.jpg',
    'https://i.pinimg.com/564x/27/5a/09/275a0989e56bef53ee2b1d87cc016598.jpg',
    'https://i.pinimg.com/564x/e4/cd/86/e4cd86d2bee898465752d8c17e64e3a3.jpg',
    'https://i.pinimg.com/564x/30/22/b5/3022b5b2c0e2ec4fe17490327d2a533d.jpg',
    'https://i.pinimg.com/564x/e4/84/6a/e4846ab2b51d789193c2d6ee4e1375da.jpg',
    'https://i.pinimg.com/564x/17/01/f5/1701f50d1b60e1154c2bc4f5aa1e34d3.jpg'
];

const animateImage = setInterval(() => {
    let rand = Math.floor(Math.random() * images.length);
    let rand_link = Math.floor(Math.random() * image_links.length);
    let duplicate = [];
    for (let l = 0; l < images_img.length; l++) {
        let source = $(images_img[l]).attr('src')
        duplicate.push(source)
    }
    if (duplicate.includes(image_links[rand_link])) {
        rand_link = Math.floor(Math.random() * image_links.length);
    }

    $(images_img[rand]).attr('src', image_links[rand_link]);

    for (let i = 0; i < images.length; i++) {
        $(images[i]).css({
            opacity: 0.7,
            transform: 'scale(1)'
        })
    }
    $(images[rand]).css({
        opacity: 1,
        transform: 'scale(1.05)'
    })
}, 5000)