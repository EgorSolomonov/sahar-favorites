var overlay,
  header_height,
  basket_count,
  quickViewPopup = ".quick-view-popup",
  offers_url_change = true;

$(document).ready(function () {
  $(".hits .js-carousel").owlCarousel({
    responsive: {
      1000: {
        items: 4,
      },
      0: {
        items: 2,
      },
    },
  });

  $(".accessories .js-carousel").owlCarousel({
    responsive: {
      1000: {
        items: 4,
      },
      0: {
        items: 2,
      },
    },
  });

  $(".similar-products .js-carousel").owlCarousel({
    responsive: {
      1000: {
        items: 4,
      },
      0: {
        items: 2,
      },
    },
  });

  overlay = $(".overlay");
  header_height = $("header").innerHeight();

  scrollTop();

  var panel_height = $("#panel").innerHeight();
  if (panel_height > 0) {
    header_basket_position();
    $(window).scroll(function () {
      header_basket_position();
    });
  }

  // left panel --------------------------------------------------------------
  var left_panel = $(".left-panel");

  $(".menu_trigger").click(function (e) {
    e.preventDefault();
    left_panel.open();
  });

  $(".left-panel .close-btn").click(function (e) {
    e.preventDefault();
    left_panel.close();
  });

  left_panel.open = function () {
    left_panel.addClass("open");
    overlay.open();
    $("body").bind("mousewheel touchmove", function (e) {
      e.preventDefault();
    });
  };

  left_panel.close = function () {
    left_panel.removeClass("open");
    overlay.close();
    $("body").unbind("mousewheel touchmove");
  };

  overlay.open = function () {
    TweenLite.to(overlay, 0.3, { autoAlpha: 1 });
  };

  overlay.close = function () {
    TweenLite.to(overlay, 0.3, { autoAlpha: 0 });
  };

  overlay.click(function () {
    if (left_panel.hasClass("open")) {
      left_panel.close();
    }
    if ($(quickViewPopup).length > 0) {
      quickViewClose();
    }
    if ($(".one-click-buy-popup").is(":visible")) {
      oneClickBuyClose();
    }
  });

  $(".body", left_panel).niceScroll({
    cursorcolor: "#fff",
    cursorborder: 0,
    cursorborderradius: 0,
    zindex: 99,
    cursoropacitymax: 0.7,
  });
  $(".bx-sidebar-block").niceScroll({
    cursorcolor: "#fff",
    cursorborder: 0,
    cursorborderradius: 0,
    zindex: 99,
    cursoropacitymax: 0.7,
    railalign: "left",
  });
  // left panel end ----------------------------------------------------------

  // scroll geo popup --------------------------------------------------------------

  $(".bxmaker_ipgeo_epilog_city_change_box .set_options").niceScroll({
    cursorcolor: "#00abdd",
    cursorborder: 0,
    cursorwidth: 4,
    cursorborderradius: 15,
    zindex: 99,
    cursoropacitymax: 0.7,
    cursoropacitymin: 0.5,
  });

  // scroll geo popup end ----------------------------------------------------------

  // basket ------------------------------------------------------------------
  $(".basket-toggle").click(function () {
    var basket = $("#basket");
    let body = $("body");

    if (basket.hasClass("open")) {
      body.removeClass("overflow");
    } else {
      body.addClass("overflow");
    }
    if (basket.hasClass("open")) {
      basket.removeClass("open");
      $(".bx-touch body").unbind("mousewheel touchmove");
    } else {
      basket.addClass("open");
      $(".bx-touch body").bind("mousewheel touchmove", function (e) {
        e.preventDefault();
      });
    }
  });
  // basket end --------------------------------------------------------------

  // quick view --------------------------------------------------------------
  $(".quick-view-btn").click(function (e) {
    e.preventDefault();

    var id = $(this).data("id"),
      href = $(this).data("href"),
      $this = $(this);

    if (id) {
      $.ajax({
        type: "post",
        url: href + "?quickview=Y",
        data: { id: id },
        dataType: "html",
        beforeSend: function () {
          $this.addClass("loading");
        },
        success: function (data) {
          $this.removeClass("loading");
          quickViewOpen(data);
        },
      });
    }
  });
  // quick view end ----------------------------------------------------------

  // one click buy -----------------------------------------------------------
  var one_click_buy = {
    open: function (name, url) {
      var html =
        "<div class='one-click-overlay'></div>" +
        "<div class='one-click-buy-popup'>" +
        "<a class='popup-close material-icons' href='#'>close</a>" +
        "<h3>Заказать в один клик</h3>" +
        "<div class='one-click-body'>" +
        "<form>" +
        "<input type='text' class='input-text' name='user_name' placeholder='Имя' />" +
        "<input type='text' class='input-text user_phone' name='user_phone' placeholder='Телефон*' />" +
        "<input type='hidden' name='product' value='" +
        name +
        "' />" +
        "<input type='hidden' name='product_url' value='" +
        url +
        "' />" +
        "<p>* - поля, обязательные для заполнения</p>" +
        "<input type='button' class='btn one-click-buy-submit' value='Отправить' />" +
        "</form>" +
        "</div>" +
        "</div>";
      $("body").append(html);
      TweenLite.to(".one-click-overlay", 0.3, { autoAlpha: 1 });
      TweenLite.to(".one-click-buy-popup", 0.2, { autoAlpha: 1, top: "50%" });
      $(".user_phone").mask("+7 (999) 999-99-99");
    },
    close: function () {
      TweenLite.to(".one-click-buy-popup", 0.2, { autoAlpha: 0, top: 0 });
      TweenLite.to(".one-click-overlay", 0.3, {
        autoAlpha: 0,
        onComplete: one_click_buy.remove,
      });
    },
    remove: function () {
      $(".one-click-overlay, .one-click-buy-popup").remove();
    },
    send: function (ajax_params) {
      $.ajax({
        type: "POST",
        url: BX.message("SITE_DIR") + "ajax/one_click_buy.php",
        data: ajax_params,
        dataType: "html",
        success: function (data) {
          $(".one-click-body").html(data);
          TweenLite.to(".one-click-buy-popup", 0.15, { height: "170px" });
          TweenLite.fromTo(
            ".one-click-body",
            0.2,
            { autoAlpha: 0, scale: 0.5 },
            { autoAlpha: 1, scale: 1 }
          );
        },
      });
    },
  };

  $(document).on("click", ".one-click-btn", function (e) {
    e.preventDefault();
    var name = $(this).data("name");
    var url = $(this).data("url");
    var offer_id = $(this).attr("data-offer-id");
    if (offer_id) {
      url += "?pid=" + offer_id;
    }
    one_click_buy.open(name, url);
  });

  $(document).on(
    "click",
    ".one-click-buy-popup .popup-close, .one-click-overlay",
    function (e) {
      e.preventDefault();
      one_click_buy.close();
    }
  );

  $(document).on("click", ".one-click-buy-submit", function () {
    var form = $(this).parents("form");
    var phone = $(".user_phone", form);
    if (phone.val() !== "" && phone.val().length > 0) {
      $(this).addClass("loading");
      phone.removeClass("error");
      var ajax_params = form.serialize();
      one_click_buy.send(ajax_params);
    } else {
      phone.addClass("error");
    }
  });
  // one click buy end -------------------------------------------------------

  // forgot password  --------------------------------------------------------
  $(".js-forgot-psw").on("click", function (e) {
    e.preventDefault();
    $(".enter__forgotpsw").slideToggle(300);
  });

  $("#enter__forgotpsw-form").on("submit", function () {
    var $this = $(this);

    $.ajax(
      {
        type: "post",
        url: BX.message("SITE_DIR") + "ajax/forgotpsw.php",
        data: $this.serialize(),
        dataType: "json",
        beforeSend: function () {
          $(".btn", $this).addClass("loading");
        },
        success: function (data) {
          $(".btn", $this).removeClass("loading");
          if (data.TYPE === "ERROR") {
            $(".enter__forgotpsw-error", $this).html(
              '<p><font class="errortext">' + data.MESSAGE + "</font></p>"
            );
          } else if (data.TYPE === "OK") {
            $this.html(
              '<p><font class="notetext">' + data.MESSAGE + "</font></p>"
            );
          }
        },
      },
      "json"
    );
    return false;
  });
  // forgot password end -----------------------------------------------------

  // sticky elements ---------------------------------------------------------

  //    $("#catalog-menu").stick_in_parent({
  //        offset_top: header_height
  //    });

  // sticky elements end -----------------------------------------------------
});

function updBasket(action, id) {
  var count_str = "",
    params = {};

  if (action === "del" && id) {
    params.type = "delete";
    params.bid = id;
  }
  $.ajax({
    type: "post",
    url: BX.message("SITE_DIR") + "ajax/basket.php",
    data: params,
    dataType: "html",
    beforeSend: function () {
      // beforeSend на кнопочки плюс и минус, чтобы были disabled пока callback не обновит корзину
      if (action === "" && id) {
        $(".quantity a.material-icons").attr("onclick", null);
      }
    },
    success: function (data) {
      $(".btn.loading").removeClass("loading");
      if (action === "del") {
        $("#basket tr#" + id).animate(
          { opacity: 0, left: "100%" },
          250,
          function () {
            updateData(data);
          }
        );
      } else {
        updateData(data);
      }
    },
  });

  function updateData(data) {
    $("#basket .basket_content").html(data);

    if (basket_count > 0) {
      count_str =
        "<span class='basket-counter bounceInDown'>" + basket_count + "</span>";
    }
    $(".basket-icon").html(count_str);
  }
}

function header_basket_position() {
  var panel_height = $("#panel").innerHeight();
  var ScrollTop = $(document).scrollTop();

  var Delta = ScrollTop - panel_height;
  if (Delta >= 0) {
    $("header, .left-panel").css({ top: "0px" });
    $("#basket").css({ top: header_height + "px" });
  } else {
    $("header, .left-panel").css({ top: Math.abs(Delta) });
    $("#basket").css({ top: Math.abs(Delta) + header_height });
  }
}

function scrollTop() {
  var fade_speed = 500,
    scroll_speed = 500,
    delta_visible = 500,
    delta_stick,
    is_visible = 0,
    el_body,
    button = $("#arrow-top"),
    offset_bottom,
    scroll_top;

  button.click(function () {
    el_body = document.documentElement.scrollTop ? "html" : "body";
    $(el_body + ":not(:animated)").animate({ scrollTop: 0 }, scroll_speed);
  });

  $(window).on("scroll touchmove", render);
  render();

  function render() {
    scroll_top = $(window).scrollTop();
    offset_bottom = $(document).height() - (scroll_top + $(window).height());
    delta_stick = $("footer").height() + 25 - offset_bottom;

    if (delta_stick >= 25) {
      button.addClass("absolute");
    } else {
      button.removeClass("absolute");
    }

    if (scroll_top > delta_visible && !is_visible) {
      button.stop().fadeIn(fade_speed);
      is_visible = 1;
    } else if (scroll_top < delta_visible && is_visible) {
      button.stop().fadeOut(fade_speed);
      is_visible = 0;
    }
  }
}

function quickViewOpen(data) {
  offers_url_change = false;
  $("body").append(data);
  overlay.open();
  TweenLite.from(quickViewPopup, 0.2, { autoAlpha: 0, top: 0 });
}

function quickViewClose() {
  offers_url_change = true;
  TweenLite.to(quickViewPopup, 0.2, {
    autoAlpha: 0,
    top: 0,
    onComplete: quickViewRemove,
  });
  overlay.close();

  function quickViewRemove() {
    $(quickViewPopup).remove();
  }
}

// Цель яндекс метрики на посещение корзины только если она закрыта(по классу)

document.addEventListener("DOMContentLoaded", function () {
  let basketBtnOpenClose = document.getElementById("basket");

  // ставлю Наблюдателя за изменением класса
  let observer = new MutationObserver((mutationRecords) => {
    mutationRecords.forEach(function (mutation) {
      //   console.log(mutation.target.className);
      if (
        mutation.attributeName === "class" &&
        mutation.target.className === "open"
      ) {
        //   вызов только если открыли корзину
        ym(89685747, "reachGoal", "openBasket");
        return true;
      }
    });
  });

  observer.observe(basketBtnOpenClose, {
    attributes: true,
  });
});
// Цель яндекс метрики на посещение корзины только если она закрыта(по классу) end

/* Избранное */

$(document).ready(function() {
  $('.favor').on('click', function(e) {
      var favorID = $(this).attr('data-item');
      if($(this).hasClass('active'))
          var doAction = 'delete';
      else
          var doAction = 'add';

      addFavorite(favorID, doAction);
  });
});

  function addFavorite(id, action)
  {
      var param = 'id='+id+"&action="+action;
      $.ajax({
          url:     '/local/ajax/favorites.php', // URL отправки запроса
          type:     "GET",
          dataType: "html",
          data: param,
          success: function(response) { // Если Данные отправлены успешно
              var result = $.parseJSON(response);
              if(result == 1){ // Если всё чётко, то выполняем действия, которые показывают, что данные отправлены :)
                   $('.favor[data-item="'+id+'"]').addClass('active');
                   var wishCount = parseInt($('#want .col').html()) + 1;
                   $('#want .col').html(wishCount); // Визуально меняем количество у иконки
              }
              if(result == 2){
                   $('.favor[data-item="'+id+'"]').removeClass('active');
                   var wishCount = parseInt($('#want .col').html()) - 1;
                   $('#want .col').html(wishCount); // Визуально меняем количество у иконки
              }
          },
          error: function(jqXHR, textStatus, errorThrown){ // Если ошибка, то выкладываем печаль в консоль
              console.log('Error: '+ errorThrown);
          }
       });
  }
   
/* Избранное */