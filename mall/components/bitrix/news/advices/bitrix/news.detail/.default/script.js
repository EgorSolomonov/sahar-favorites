$(document).ready(function() {
    $(".advice-recommend-block .js-carousel").owlCarousel({
        items: 5,
        dots: false,
        nav: true,
        navClass: ['btn-circle btn-circle_prev', 'btn-circle btn-circle_next'],
        navText: "",
        navRewind: false,
        responsiveRefreshRate: 0,
        mouseDrag: false
    });
});