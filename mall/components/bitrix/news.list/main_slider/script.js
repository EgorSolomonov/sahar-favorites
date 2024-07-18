$(document).ready(function(){   
    
    $(".main_slider").owlCarousel({
        items: 1,
        mouseDrag: false,
        autoplay: true,
        autoplayTimeout: 5000,
        loop: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
    });
});