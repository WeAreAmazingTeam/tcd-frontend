let navOuterHeight = $('nav').outerHeight();

$(window).scroll(function() {
    if ($(window).scrollTop() > 10) {
        $('nav').addClass('navbar-shadow');
    } else {
        $('nav').removeClass('navbar-shadow');
    }
});

function renderTooltip() {
    $('[data-toggle="tooltip"]').tooltip()
}

$('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event){
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname){
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length){
            event.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top-navOuterHeight+25
            }, 1000);
        }
    }
});

var lazyLoadImages = document.querySelectorAll('img[data-src]');

window.onscroll = function() {
    runLazyLoading();
}

window.onresize = function() {
    runLazyLoading();
}

function lazyLoading() {
    lazyLoadImages = document.querySelectorAll('img[data-src]');
    runLazyLoading();
}

function runLazyLoading() {
    for (var i=0; i < lazyLoadImages.length; i++) {
        if (inView(lazyLoadImages[i])){
            if (lazyLoadImages[i].getAttribute('data-src')) {
                lazyLoadImages[i].src = lazyLoadImages[i].getAttribute('data-src');
                lazyLoadImages[i].removeAttribute('data-src');
            }
        }
    }
    cli();
}

function inView(e) {
    var r = e.getBoundingClientRect();
    return (r.top >= 0 - 300 && r.left >= 0 && (r.bottom <= ((window.innerHeight || document.documentElement.clientHeight)) + 300) && r.right <= (window.innerWidth || document.documentElement.clientWidth));
}

function cli() {
    lazyLoadImages = Array.prototype.filter.call(lazyLoadImages, function(e){
        return e.getAttribute('data-src');
    });
}

$(function() {
    renderTooltip();
    lazyLoading();
});