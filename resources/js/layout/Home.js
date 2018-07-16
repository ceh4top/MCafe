var W = $(window);
W.WH = 0;
W.WW = 0;
W.WS = 0;

$(document).ready(Ready);
W.resize(Resize);
W.scroll(Scroll);

function Ready() {
    W.WH = W.height();
    W.WW = W.width();
    W.WS = W.scrollTop();
}

function Resize() {
    W.WH = W.height();
    W.WW = W.width();
    W.WS = W.scrollTop();
}

function Scroll() {
    W.WS = W.scrollTop();

    if (W.WS > W.WH / 3) {
        $("header").addClass("White")
            .find(".Logo").attr("src", "/IMAGE/system/mcafe_black.png");
    } else {
        $("header").removeClass("White")
            .find(".Logo").attr("src", "/IMAGE/system/mcafe.png");
    }

    var Menu = $("header .Menu .element");
    $.each(Menu, function (i, v) {
        v = $(v);
        var Element = $("#" + v.data("name")),
            EH = Element.height(),
            ET = Element.offset().top;

        if (ET <= W.WS + 15)
        {
            Menu.removeClass("active");
            v.addClass("active");
        }
    });
}

function Go(Name) {
    var Block = $("#" + Name),
        Offset = Block.offset();

    var body = $("html, body");
    body.stop().animate({scrollTop:Offset.top}, 500);
}