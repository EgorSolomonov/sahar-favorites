<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.mall") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.mall") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="wrapper advice-detail-wrp">
    <div class="advice-detail">
            <h1><?=$arResult["NAME"]?></h1>
            <div class="advice-detail__content">
                <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
                        <img    
                                class="advice-detail__img"
                                src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
                                alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
                                title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
                                />
                <?endif?>
                <?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
                        <div class="advice-detail__date"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></div>
                <?endif;?>
                <?if(strlen($arResult["DETAIL_TEXT"])>0):?>
                        <?echo $arResult["DETAIL_TEXT"];?>
                <?else:?>
                        <?echo $arResult["PREVIEW_TEXT"];?>
                <?endif?>
                <?
                if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
                {
                        ?>
                        <div class="news-detail-share">
                                <noindex>
                                <?
                                $APPLICATION->IncludeComponent("bitrix:main.share", "", array(
                                                "HANDLERS" => $arParams["SHARE_HANDLERS"],
                                                "PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
                                                "PAGE_TITLE" => $arResult["~NAME"],
                                                "SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                                                "SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                                                "HIDE" => $arParams["SHARE_HIDE"],
                                        ),
                                        $component,
                                        array("HIDE_ICONS" => "Y")
                                );
                                ?>
                                </noindex>
                        </div>
                        <?
                }
                ?>
            </div>
            <div class="advice-navigation">
                <?
                // Если есть предыдущий элемент то выводим ссылку
                if (is_array($arResult['PREVIOUS']))
                {
                ?>
                    <a class="advice-navigation__prev" href="<?=$arResult['PREVIOUS']['URL']?>"><span class="btn-circle btn-circle_small btn-circle_small_prev"></span><span class="advice-navigation__text"><?=GetMessage("PREV")?></span></a>
                <?
                }
                ?>
                <?
                // Если есть следущий элемент то выводим ссылку
                if (is_array($arResult['NEXT']))
                {
                ?>
                   <a class="advice-navigation__next" href="<?=$arResult['NEXT']['URL']?>"><span class="advice-navigation__text advice-navigation__text_next"><?=GetMessage("NEXT")?></span><span class="btn-circle btn-circle_small btn-circle_small_next"></span></a>
                <?
                }
                ?>
            </div>
    </div>
    <?
    global $arrLastAdvicesFilter;
    $arrLastAdvicesFilter = array("!ID"=>$arResult['ID']);

    $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "last_advices",
            Array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "N",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "N",
                    "DISPLAY_PREVIEW_TEXT" => "N",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array("", ""),
                    "FILTER_NAME" => "arrLastAdvicesFilter",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                    "IBLOCK_TYPE" => "content",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "N",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "7",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array("", ""),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC"
            ),
            $component,
            array("HIDE_ICONS" => "Y")
    );?>
</div>
<? if(!empty($arResult["PROPERTIES"]["RECOMMEND"]["VALUE"])): ?>
    <div class="advice-recommend-block">
        <div class="wrapper">   
            <h2><?=GetMessage("RECOMMEND");?></h2>
        </div> 
        <div class="prod-carousel">
            <?
            global $arrFilter;
            $arrFilter = array("ID"=>$arResult['PROPERTIES']['RECOMMEND']['VALUE']);

            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "products_carousel",
                Array(
                        "ACTION_VARIABLE" => "action",
                        "ADD_PICT_PROP" => "-",
                        "ADD_PROPERTIES_TO_BASKET" => "Y",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "ADD_TO_BASKET_ACTION" => "ADD",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "BACKGROUND_IMAGE" => "-",
                        "BASKET_URL" => "/personal/basket.php",
                        "BROWSER_TITLE" => "-",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "CONVERT_CURRENCY" => "N",
                        "DETAIL_URL" => "",
                        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "DISPLAY_TOP_PAGER" => "N",
                        "ELEMENT_SORT_FIELD" => "sort",
                        "ELEMENT_SORT_FIELD2" => "id",
                        "ELEMENT_SORT_ORDER" => "asc",
                        "ELEMENT_SORT_ORDER2" => "desc",
                        "FILTER_NAME" => "arrFilter",
                        "HIDE_NOT_AVAILABLE" => "N",
                        "IBLOCK_ID" => "3",
                        "IBLOCK_TYPE" => "catalog",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "LABEL_PROP" => "-",
                        "LINE_ELEMENT_COUNT" => "3",
                        "MESSAGE_404" => "",
                        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                        "MESS_BTN_BUY" => "Купить",
                        "MESS_BTN_DETAIL" => "Подробнее",
                        "MESS_BTN_SUBSCRIBE" => "Подписаться",
                        "MESS_NOT_AVAILABLE" => "Нет в наличии",
                        "META_DESCRIPTION" => "-",
                        "META_KEYWORDS" => "-",
                        "OFFERS_CART_PROPERTIES" => array(),
                        "OFFERS_FIELD_CODE" => array("", ""),
                        "OFFERS_LIMIT" => "5",
                        "OFFERS_PROPERTY_CODE" => array("SIZE", ""),
                        "OFFERS_SORT_FIELD" => "sort",
                        "OFFERS_SORT_FIELD2" => "id",
                        "OFFERS_SORT_ORDER" => "asc",
                        "OFFERS_SORT_ORDER2" => "desc",
                        "OFFER_ADD_PICT_PROP" => "-",
                        "OFFER_TREE_PROPS" => array("SIZE"),
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Товары",
                        "PAGE_ELEMENT_COUNT" => "200",
                        "PARTIAL_PRODUCT_PROPERTIES" => "N",
                        "PRICE_CODE" => array("RUB"),
                        "PRICE_VAT_INCLUDE" => "Y",
                        "PRODUCT_DISPLAY_MODE" => "Y",
                        "PRODUCT_ID_VARIABLE" => "id",
                        "PRODUCT_PROPERTIES" => array(),
                        "PRODUCT_PROPS_VARIABLE" => "prop",
                        "PRODUCT_QUANTITY_VARIABLE" => "",
                        "PRODUCT_SUBSCRIPTION" => "N",
                        "PROPERTY_CODE" => array("", ""),
                        "SECTION_CODE" => "",
                        "SECTION_CODE_PATH" => "",
                        "SECTION_ID" => "",
                        "SECTION_ID_VARIABLE" => "SECTION_ID",
                        "SECTION_URL" => "",
                        "SECTION_USER_FIELDS" => array("", ""),
                        "SEF_MODE" => "N",
                        "SEF_RULE" => "",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SHOW_ALL_WO_SECTION" => "Y",
                        "SHOW_CLOSE_POPUP" => "Y",
                        "SHOW_DISCOUNT_PERCENT" => "N",
                        "SHOW_OLD_PRICE" => "Y",
                        "SHOW_PRICE_COUNT" => "1",
                        "TEMPLATE_THEME" => "blue",
                        "USE_MAIN_ELEMENT_SECTION" => "N",
                        "USE_PRICE_COUNT" => "N",
                        "USE_PRODUCT_QUANTITY" => "N"
                ),
                $component,
                array("HIDE_ICONS" => "Y")
            );?>
        </div>
    </div>
<? endif; ?>