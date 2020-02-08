

var lastPosition = 0;
var ticking = false;

function onScroll(position_scroll) {
    let img = document.getElementById("img-header");
    let navbar = document.getElementById("navbar");
    let navlink = document.getElementsByClassName("nav-link");

    let position_change = img.offsetHeight - navbar.offsetHeight - 20;

    if(position_scroll >= position_change){
        navbar.style.backgroundColor = "rgba(255, 79, 23, 0.8)";
        for(let i = 0; i < navlink.length; i++){
            navlink[i].style.color = "#1C221F";
        }
    }
    else {
        navbar.style.backgroundColor = "rgba(28, 34, 31, 0.8)";
        for(let i = 0; i < navlink.length; i++){
            navlink[i].style.color = "#FF4F17";
        }
    }

}

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