var $ = jQuery,
    Data = {};

$(document).ready(Init);
$(window).resize(Resize);
$(window).scroll(Scroll);

function Init() {
    Data.Header = $("header");
    Data.Window = $(window);
    Resize();
    Scroll();
}

function Resize() {

}

function Scroll() {
    var scrollTop = Data.Window.scrollTop();
    HeaderScroll(scrollTop);
}

function HeaderScroll(scrollTop) {
    var offset = Data.Header.offset();
    if (scrollTop > 100)
        Data.Header.addClass("min");
    else
        Data.Header.removeClass("min");
}