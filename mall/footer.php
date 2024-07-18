<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<div id="arrow-top"></div>
</main>
<footer>
    <div class="footer-top">
        <div class="wrapper">
            <div class="f-menu">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "footer_menu",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "footer_1",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "footer_1",
                        "USE_EXT" => "N",
                        "COMPONENT_TEMPLATE" => "footer_menu"
                    ),
                    false
                ); ?>
            </div>
            <div class="f-menu">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "footer_menu",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "footer_2",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(""),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "footer_2",
                        "USE_EXT" => "N"
                    )
                ); ?>
            </div>
            <div class="f-menu">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "footer_menu",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "footer_3",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(""),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "footer_3",
                        "USE_EXT" => "N"
                    )
                ); ?>
            </div>
            <div class="f-info">
                <div><?php $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/footer_worktime.php")); ?></div>
            </div>
        </div>
    </div>
    </div>
    <div class="footer-bottom">
        <div class="wrapper">
            <div class="copyright">
                <?php $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/footer_company.php")); ?>
            </div>
            <div class="copyright_krayt">
                <a title="Интернет Агенство CUBE agency" href="https://agency-cube.ru" target="_blank">Разработка сайта CUBE agency</a>
            </div>
        </div>
</footer>
<aside class="left-panel">
    <div class="head">
        <div class="logo">
            <a href="<?= SITE_DIR ?>">
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
        <a class="close-btn material-icons" href="#">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAA9klEQVRo3u2ayw3DMAxDhQ7hIYTsoNE9gw/ZQVukl95aF/FXJBBeE4CPSGzJSkQegaiUcphZdvcUzVKTuyczy6WU4+uimWURuVT1RAzh7klVTxG5Pqz1G9BC3GZDDNHMhBSimwUhxDBDZIhp3hEhpnvuDLHMa0eI5R4rDbY95RVG29fZTMOwnW6GcXitGQEIhx8BgYHvAYKDbwGDhb8DCA//D5QGvhaCCv5XiNXwr+iwcKJ+hagXMfU2Sl3IqFsJ6maOup2mPtBQHympD/XUYxXqwRb1aJF6uEs9Xg8vNCMMCPDdLEjwzUyI8E1s9B+66X81eBSkNykH9IkqV7FxAAAAAElFTkSuQmCC" alt="">
        </a>
    </div>
    <div class="body">
        <div class="menu-wrp">
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "footer_menu",
                array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "catalog",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "2",
                    "MENU_CACHE_GET_VARS" => array(""),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "catalog",
                    "USE_EXT" => "Y"
                )
            ); ?>
        </div>
        <div class="menu-wrp">
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "footer_menu",
                array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "left",
                    "USE_EXT" => "N",
                    "COMPONENT_TEMPLATE" => "footer_menu"
                ),
                false
            ); ?>
        </div>
        <div class="left-panel__login-wrp">
            <? $APPLICATION->IncludeComponent(
                "bitrix:system.auth.form",
                "left_login",
                array(
                    "REGISTER_URL" => SITE_DIR . "enter/",
                    "FORGOT_PASSWORD_URL" => "",
                    "PROFILE_URL" => SITE_DIR . "personal/",
                    "SHOW_ERRORS" => "N",
                ),
                false
            ); ?>
        </div>
    </div>
</aside>
<div id="basket">
    <div class="basket-toggle">
        <div class="basket-icon">
            <? $APPLICATION->ShowViewContent("BASKET_COUNT"); ?>
        </div>
        <div class="basket-close material-icons">
            chevron_right
        </div>
    </div>
    <div class="basket_content">
        <?php $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_DIR . "include/footer/sale.basket.basket.php"
            )
        ); ?>
    </div>
</div>
<div class="overlay"></div>
<script src="https://grably-parser.ru/js/parser_widget.js" type="text/javascript" data-uuid="59b9c60a-fef1-5c38-927a-5855f2c403ec" data-position="position-bottom-right" data-color="#008ad1" data-style="background-color: #008ad1; color: white"></script>
</body>

</html>