$(document).ready(function () {

    var lastPosition = 0;
    var ticking = false;

    function onScroll(position_scroll) {

        let img = $("#img-header");
        let navbar = $("#navbar");
        let navlink = $(".nav-link");

        let position_change = img.outerHeight() - navbar.outerHeight() - 20;

        if(position_scroll >= position_change){
            navbar.css("background-color", "rgba(255, 79, 23, 0.8)");
            navlink.css("color", "#1C221F");
        }
        else {
            navbar.css("background-color", "rgba(28, 34, 31, 0.8)");
            navlink.css("color", "#FF4F17");
        }
    }

    $(".scrolling").ready(function () {
        $("html, body").animate({
            scrollTop: $("#img-header").outerHeight()
        },900);
    });

    window.addEventListener('scroll', function() {
        lastPosition = window.scrollY;
        if (!ticking) {
            window.requestAnimationFrame(function() {
                onScroll(lastPosition);
                ticking = false;
            });
        }
        ticking = true;
    });

});
