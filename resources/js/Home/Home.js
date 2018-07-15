function Bottom() {
    $('html,body').animate({scrollTop:$('#Banquet').offset().top+"px"},{duration:500});
}

$(document).ready(Ready);
W.resize(Resize);
W.scroll(Scroll);

function Ready() {
    Resize();
}
function Resize() {
    Scroll();
}
function Scroll() {
    var ParallaxScrolling = $(".ParallaxScrolling");
    $.each(ParallaxScrolling, function (i, v) {
        var element = $(v);
        var PSTop = element.offset().top,
            PSHeight = element.height(),
            PWW = W.WS - PSTop - PSHeight,
            ParallaxScrollingTop =  PWW / 2,
            PSWidth = Math.max(PSHeight * 8 / 3, W.WW);
        element.css({
            "background-position": "center " + ParallaxScrollingTop + "px",
            "background-size": PSWidth + "px"
        });
    });
}

function Slider(object) {
    var Element = $(object),
        Arrow = Element.hasClass("Left"),
        Slider = Element.closest(".Blocks"),
        Active = Slider.find(".Block.Active"),
        Left = Slider.find(".Block.Left"),
        Right = Slider.find(".Block.Right");

    if (Arrow) {
        Right.removeClass("Right");
        Active.removeClass("Active").addClass("Right");
        Left.removeClass("Left").addClass("Active");

        if (Left.prev().hasClass("Block"))
            Left.prev().addClass("Left");
        else
            Slider.find(".Block").last().addClass("Left");
    } else {
        Left.removeClass("Left");
        Active.removeClass("Active").addClass("Left");
        Right.removeClass("Right").addClass("Active");

        if (Right.next().hasClass("Block"))
            Right.next().addClass("Right");
        else
            Slider.find(".Block").first().addClass("Right");
    }
}