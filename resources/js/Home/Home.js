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
    /*var ParallaxScrolling = $(".ParallaxScrolling");
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
    });*/
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

/*Menu*/

function addPage(page, book) {

    var id, pages = book.turn('pages');

    // Create a new element for this page
    var element = $('<div />', {});

    // Add the page to the flipbook
    if (book.turn('addPage', element, page)) {

        // Add the initial HTML
        // It will contain a loader indicator and a gradient
        element.html('<div class="gradient"></div><div class="loader"></div>');

        // Load the page
        loadPage(page, element);
    }

}

function loadPage(page, pageElement) {

    // Create an image element

    var img = $('<img />');

    img.mousedown(function(e) {
        e.preventDefault();
    });

    img.load(function() {

        // Set the size
        $(this).css({width: '100%', height: '100%'});

        // Add the image to the page after loaded

        $(this).appendTo(pageElement);

        // Remove the loader indicator

        pageElement.find('.loader').remove();
    });

    // Load the page

    img.attr('src', 'pages/' +  page + '.jpg');

}


function loadLargePage(page, pageElement) {

    var img = $('<img />');

    img.load(function() {

        var prevImg = pageElement.find('img');
        $(this).css({width: '100%', height: '100%'});
        $(this).appendTo(pageElement);
        prevImg.remove();

    });

    // Loadnew page

    img.attr('src', 'pages/' +  page + '-large.jpg');
}


function loadSmallPage(page, pageElement) {

    var img = pageElement.find('img');

    img.css({width: '100%', height: '100%'});

    img.unbind('load');
    // Loadnew page

    img.attr('src', 'pages/' +  page + '.jpg');
}

// http://code.google.com/p/chromium/issues/detail?id=128488
function isChrome() {

    return navigator.userAgent.indexOf('Chrome')!=-1;

}

function loadApp() {

    // Create the flipbook

    $('.flipbook').turn({
        // Width

        width:922,

        // Height

        height:600,

        // Elevation

        elevation: 50,

        // Enable gradients

        gradients: true,

        // Auto center this flipbook

        autoCenter: true

    });
}

// Load the HTML4 version if there's not CSS transform

yepnope({
    test : Modernizr.csstransforms,
    yep: ['/SCRIPT/system/turn/turn.min.js'],
    nope: ['/SCRIPT/system/turn/turn.html4.min.js'],
    both: ['/STYLE/Home/Menu.min.css'],
    complete: loadApp
});