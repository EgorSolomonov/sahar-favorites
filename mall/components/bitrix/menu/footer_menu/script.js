$(document).ready(function () {

    $('.cat_block').click(function () {
        $(this).toggleClass('left_menu_cat_block_active');
            if($(this).hasClass('left_menu_cat_block_active')){
                $(this).parent().find('ul').slideDown();
                $(this).parent().find('ul').find('li').find('a').css('padding-left','30px');
                $(this).prev('a').addClass('left_menu_a_active');
            }
        else {
            $(this).parent().find('ul').slideUp();
            $(this).prev('a').removeClass('left_menu_a_active');
        }
    });

    $('.left-panel .menu-wrp ul li .root-item').hover(
        function () {
            $(this).next('.cat_block').addClass('cat_block_hover');
        },
        function () {
            $(this).next('.cat_block').removeClass('cat_block_hover');
        });

    if($('.root-item').hasClass('selected')){
        $('.left-panel .menu-wrp ul li a.selected').next().addClass('cat_block_hover');
        $('.left-panel .menu-wrp ul li .root-item.selected').hover(
            function () {
                $(this).next('.cat_block').addClass('cat_block_hover');
            },
            function () {
                $(this).next('.cat_block').addClass('cat_block_hover');
            });
    }

});



