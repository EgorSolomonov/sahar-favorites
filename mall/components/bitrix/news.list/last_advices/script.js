$(document).ready(function() {

    var win_width = $(window).width();

    if (win_width < 1300) {
        $(".other-advices").trigger("sticky_kit:detach");
    } else {
        make_sticky();
    }

    $(window).resize(function() {

        win_width = $(window).width();

        if (win_width < 1300) {
            $(".other-advices").trigger("sticky_kit:detach");
        } else {
            make_sticky();
        }

    });

    function make_sticky() {

        $(".other-advices").stick_in_parent({
            offset_top: header_height + 20,
            parent: ".advice-detail-wrp",
            spacer: false
        });
    }
});