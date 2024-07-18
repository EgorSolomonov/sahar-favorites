<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
CJSCore::Init(array("jquery2", "ajax", "popup", "fx"));

if (
    \Bitrix\Main\Loader::includeSharewareModule("krayt.mall") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED ||
    \Bitrix\Main\Loader::includeSharewareModule("krayt.mall") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
) {
    $APPLICATION->IncludeFile(SITE_DIR . 'include/alert_install.php');
    die();
}

?>
<!DOCTYPE html>
<html>

<head>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DKYD8J8WH9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-DKYD8J8WH9');
    </script>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <title><? $APPLICATION->ShowTitle(); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    <?
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/reset.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/js/owlcarousel/owl.carousel.css");

    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/owlcarousel/owl.carousel.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.nicescroll.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/catalog.element/script.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/gsap/TweenLite.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/gsap/CSSPlugin.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.maskedinput.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.sticky-kit.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/script.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/zoom.js");
    ?>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-T7P9R9B');
    </script>
    <!-- End Google Tag Manager -->

    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <? $APPLICATION->ShowHead(); ?>

    <!-- Top.Mail.Ru counter -->
    <script type="text/javascript">
        var _tmr = window._tmr || (window._tmr = []);
        _tmr.push({
            id: "3322476",
            type: "pageView",
            start: (new Date()).getTime()
        });
        (function(d, w, id) {
            if (d.getElementById(id)) return;
            var ts = d.createElement("script");
            ts.type = "text/javascript";
            ts.async = true;
            ts.id = id;
            ts.src = "https://top-fwz1.mail.ru/js/code.js";
            var f = function() {
                var s = d.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(ts, s);
            };
            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, "tmr-code");
    </script>
    <noscript>
        <div><img src="https://top-fwz1.mail.ru/counter?id=3322476;js=na" style="position:absolute;left:-9999px;" alt="</span><span style=" font-family:'Calibri';font-size:11pt;color:#000000;mso-style-textfill-fill-color:#000000">Top.Mail.Ru" /></div>
    </noscript>
    <!-- /Top.Mail.Ru counter -->

    <!-- Yandex.Metrika counter -->
    <!-- <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            for (var j = 0; j < document.scripts.length; j++) {
                if (document.scripts[j].src === r) {
                    return;
                }
            }
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(89685747, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true,
            ecommerce: "dataLayer"
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/89685747" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript> -->
    <!-- /Yandex.Metrika counter -->

    <!-- <script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src='https://vk.com/js/api/openapi.js?169',t.onload=function(){VK.Retargeting.Init("VK-RTRG-1490553-5bULY"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script><noscript><img src="https://vk.com/rtrg?p=VK-RTRG-1490553-5bULY" style="position:fixed; left:-999px;" alt=""/></noscript> -->
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T7P9R9B" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="panel">
        <? $APPLICATION->ShowPanel(); ?>
    </div>
    <header>

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-4T8EST0Z7C"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-4T8EST0Z7C');
        </script>
        <? if ($APPLICATION->GetCurPage() == '/_/') : ?>
            <? echo ($APPLICATION->GetCurPage()) ?>
        <? endif; ?>
        <div class="header_top_menu">
            <div class="left">
                <a class="menu_trigger material-icons" href="#">
                    <?php $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/header/icon_menu.php"
                        )
                    ); ?>
                </a>

                <a class="header_favorite" href="/favorite/">
                    <?php $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/header/icon_favorite.php"
                        )
                    ); ?>
                </a>
            </div>
            <div class="center">
                <a class="logo" href="<?= SITE_DIR ?>">
                    <?php $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/header/logo.php"
                        )
                    ); ?>

                </a>
            </div>
            <div class="right">
                <div class="phone">
                    <div class="number"><?php $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/phone.php")); ?></div>
                </div>
                <div class="geolocation">
                    <? if (CModule::IncludeModule("bxmaker.geoip")) : ?>
                        <?php $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/header/geo_city.php"
                            )
                        ); ?>
                    <? endif; ?>
                </div>
                <div class="basket-toggle">
                    <div onclick="ym(89685747,'reachGoal','mobileBasket'); return true;" class="basket-icon basket-icon__black">
                        <? $APPLICATION->ShowViewContent("BASKET_COUNT"); ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="header_bottom_menu">


            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "catalog_menu",
                array(
                    "ROOT_MENU_TYPE" => "top",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_CACHE_GET_VARS" => array(),
                    "MAX_LEVEL" => "2",
                    "CHILD_MENU_TYPE" => "catalog",
                    "USE_EXT" => "Y",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N",
                    "COMPONENT_TEMPLATE" => "catalog_menu"
                ),
                false
            ); ?>


            <? $APPLICATION->IncludeComponent(
                "bitrix:search.title",
                ".default",
                array(
                    "CHECK_DATES" => "N",
                    "CONTAINER_ID" => "title-search",
                    "INPUT_ID" => "title-search-input",
                    "NUM_CATEGORIES" => "1",
                    "ORDER" => "date",
                    "PAGE" => "#SITE_DIR#search/index.php",
                    "SHOW_INPUT" => "Y",
                    "SHOW_OTHERS" => "N",
                    "TOP_COUNT" => "5",
                    "USE_LANGUAGE_GUESS" => "N",
                    "COMPONENT_TEMPLATE" => ".default",
                    "CATEGORY_0_TITLE" => "",
                    "CATEGORY_0" => array(),
                    "PRICE_CODE" => "",
                    "PRICE_VAT_INCLUDE" => "Y",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "SHOW_PREVIEW" => "Y",
                    "CONVERT_CURRENCY" => "N",
                    "TEMPLATE_THEME" => "blue",
                    "PREVIEW_WIDTH" => "75",
                    "PREVIEW_HEIGHT" => "75"
                ),
                false
            ); ?>

        </div>

    </header>
    <main>
        <? $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "breadcrumb",
            array(
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0"
            )
        ); ?>