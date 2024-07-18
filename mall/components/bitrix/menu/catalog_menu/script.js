// var jshover = function()
// {
// 	var menuDiv = document.getElementById("horizontal-multilevel-menu")
// 	if (!menuDiv)
// 		return;
//
// 	var sfEls = menuDiv.getElementsByTagName("li");
// 	for (var i=0; i<sfEls.length; i++)
// 	{
// 		sfEls[i].onmouseover=function()
// 		{
// 			this.className+=" jshover";
// 		}
// 		sfEls[i].onmouseout=function()
// 		{
// 			this.className=this.className.replace(new RegExp(" jshover\\b"), "");
// 		}
// 	}
// }
//
// if (window.attachEvent)
// 	window.attachEvent("onload", jshover);
//
$(document).ready(function(){
    $('#catalog-menu li').hover(
        function () {
            $('ul', this).stop().slideDown(200).addClass('mt50');
        },
        function () {
            $('ul', this).stop().slideUp(200);
        }
    );

    $('#catalog-menu li ul').hover(
        function () {
            $(this).prev('a').find('.catalog_submenu_hover').addClass('catalog_submenu_hover_active');
        },
        function () {
            $(this).prev('a').find('.catalog_submenu_hover').removeClass('catalog_submenu_hover_active');
        }
    );
});