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
/** @var CBitrixBasketComponent $component */
?>

<?

    $normalCount = count($arResult["ITEMS"]["AnDelCanBuy"]);
    $normalHidden = ($normalCount == 0) ? 'style="display:none;"' : '';

    $delayCount = count($arResult["ITEMS"]["DelDelCanBuy"]);
    $delayHidden = ($delayCount == 0) ? 'style="display:none;"' : '';

    $subscribeCount = count($arResult["ITEMS"]["ProdSubscribe"]);
    $subscribeHidden = ($subscribeCount == 0) ? 'style="display:none;"' : '';

    $naCount = count($arResult["ITEMS"]["nAnCanBuy"]);
    $naHidden = ($naCount == 0) ? 'style="display:none;"' : '';

?>

<? if($normalCount > 0) { ?>
    <? $this->setViewTarget("BASKET_COUNT"); ?>
        <span class="basket-counter"><?=$normalCount?></span>
    <? $this->endViewTarget(); ?>
<? } ?>
<script>
    basket_count = <?=$normalCount?>;
</script>

<div class="b_head">
    <h2><?=GetMessage("BASKET");?></h2>
    <? //if($normalCount > 0) { ?>
        <span><?=GetMessage("SALE_TOTAL")?></span>
        <span id="allSum_FORMATED" class="total_sum"><?=$arResult["allSum_FORMATED"];?></span>
<!--        <img class="loader" src="--><?//=SITE_TEMPLATE_PATH?><!--/images/loader.svg" alt="">-->
    <? //} ?>
</div>
<div class="b_body">
<?
$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
);
$this->addExternalCss($templateData['TEMPLATE_THEME']);

$curPage = $APPLICATION->GetCurPage().'?'.$arParams["ACTION_VARIABLE"].'=';
$arUrls = array(
	"delete" => $curPage."delete&id=#ID#",
	"delay" => $curPage."delay&id=#ID#",
	"add" => $curPage."add&id=#ID#",
);
unset($curPage);

$arBasketJSParams = array(
	'SALE_DELETE' => GetMessage("SALE_DELETE"),
	'SALE_DELAY' => GetMessage("SALE_DELAY"),
	'SALE_TYPE' => GetMessage("SALE_TYPE"),
	'TEMPLATE_FOLDER' => $templateFolder,
	'DELETE_URL' => $arUrls["delete"],
	'DELAY_URL' => $arUrls["delay"],
	'ADD_URL' => $arUrls["add"],
	'EVENT_ONCHANGE_ON_START' => (!empty($arResult['EVENT_ONCHANGE_ON_START']) && $arResult['EVENT_ONCHANGE_ON_START'] === 'Y') ? 'Y' : 'N'
);
?>
<script type="text/javascript">
	var basketJSParams = <?=CUtil::PhpToJSObject($arBasketJSParams);?>
</script>
<?
$APPLICATION->AddHeadScript($templateFolder."/script.js");

if($arParams['USE_GIFTS'] === 'Y' && $arParams['GIFTS_PLACE'] === 'TOP')
{
	$APPLICATION->IncludeComponent(
		"bitrix:sale.gift.basket",
		".default",
		array(
			"SHOW_PRICE_COUNT" => 1,
			"PRODUCT_SUBSCRIPTION" => 'N',
			'PRODUCT_ID_VARIABLE' => 'id',
			"PARTIAL_PRODUCT_PROPERTIES" => 'N',
			"USE_PRODUCT_QUANTITY" => 'N',
			"ACTION_VARIABLE" => "actionGift",
			"ADD_PROPERTIES_TO_BASKET" => "Y",

			"BASKET_URL" => $APPLICATION->GetCurPage(),
			"APPLIED_DISCOUNT_LIST" => $arResult["APPLIED_DISCOUNT_LIST"],
			"FULL_DISCOUNT_LIST" => $arResult["FULL_DISCOUNT_LIST"],

			"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
			"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_SHOW_VALUE"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],

			'BLOCK_TITLE' => $arParams['GIFTS_BLOCK_TITLE'],
			'HIDE_BLOCK_TITLE' => $arParams['GIFTS_HIDE_BLOCK_TITLE'],
			'TEXT_LABEL_GIFT' => $arParams['GIFTS_TEXT_LABEL_GIFT'],
			'PRODUCT_QUANTITY_VARIABLE' => $arParams['GIFTS_PRODUCT_QUANTITY_VARIABLE'],
			'PRODUCT_PROPS_VARIABLE' => $arParams['GIFTS_PRODUCT_PROPS_VARIABLE'],
			'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
			'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
			'SHOW_NAME' => $arParams['GIFTS_SHOW_NAME'],
			'SHOW_IMAGE' => $arParams['GIFTS_SHOW_IMAGE'],
			'MESS_BTN_BUY' => $arParams['GIFTS_MESS_BTN_BUY'],
			'MESS_BTN_DETAIL' => $arParams['GIFTS_MESS_BTN_DETAIL'],
			'PAGE_ELEMENT_COUNT' => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],
			'CONVERT_CURRENCY' => $arParams['GIFTS_CONVERT_CURRENCY'],
			'HIDE_NOT_AVAILABLE' => $arParams['GIFTS_HIDE_NOT_AVAILABLE'],

			"LINE_ELEMENT_COUNT" => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],
		),
		false
	);
}

if (strlen($arResult["ERROR_MESSAGE"]) <= 0)
{
	?>
	<div id="warning_message">
		<?
		if (!empty($arResult["WARNING_MESSAGE"]) && is_array($arResult["WARNING_MESSAGE"]))
		{
			foreach ($arResult["WARNING_MESSAGE"] as $v)
				ShowError($v);
		}
		?>
	</div>
	
		<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="basket_form" id="basket_form">
			<div id="basket_form_container">
				<div class="bx_ordercart">
					<?
					include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items.php");
					//include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_delayed.php");
					//include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_subscribed.php");
					//include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_not_available.php");
					?>
				</div>
			</div>
			<input type="hidden" name="BasketOrder" value="BasketOrder" />
			<!-- <input type="hidden" name="ajax_post" id="ajax_post" value="Y"> -->
		</form>
	<?

	if($arParams['USE_GIFTS'] === 'Y' && $arParams['GIFTS_PLACE'] === 'BOTTOM')
	{
		?>
		<div style="margin-top: 35px;"><? $APPLICATION->IncludeComponent(
	"bitrix:sale.gift.basket", 
	"gift_custom", 
	array(
		"SHOW_PRICE_COUNT" => "1",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"ACTION_VARIABLE" => "actionGift",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"BASKET_URL" => $APPLICATION->GetCurPage(),
		"APPLIED_DISCOUNT_LIST" => $arResult["APPLIED_DISCOUNT_LIST"],
		"FULL_DISCOUNT_LIST" => $arResult["FULL_DISCOUNT_LIST"],
		"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
		"PRICE_VAT_INCLUDE" => "N",
		"CACHE_GROUPS" => "N",
		"BLOCK_TITLE" => $arParams["GIFTS_BLOCK_TITLE"],
		"HIDE_BLOCK_TITLE" => "N",
		"TEXT_LABEL_GIFT" => $arParams["GIFTS_TEXT_LABEL_GIFT"],
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["GIFTS_PRODUCT_QUANTITY_VARIABLE"],
		"PRODUCT_PROPS_VARIABLE" => $arParams["GIFTS_PRODUCT_PROPS_VARIABLE"],
		"SHOW_OLD_PRICE" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_NAME" => "Y",
		"SHOW_IMAGE" => "Y",
		"MESS_BTN_BUY" => $arParams["GIFTS_MESS_BTN_BUY"],
		"MESS_BTN_DETAIL" => $arParams["GIFTS_MESS_BTN_DETAIL"],
		"PAGE_ELEMENT_COUNT" => $arParams["GIFTS_PAGE_ELEMENT_COUNT"],
		"CONVERT_CURRENCY" => "N",
		"HIDE_NOT_AVAILABLE" => "N",
		"LINE_ELEMENT_COUNT" => $arParams["GIFTS_PAGE_ELEMENT_COUNT"],
		"COMPONENT_TEMPLATE" => "gift_custom",
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_ID" => "",
		"SHOW_FROM_SECTION" => "N",
		"SECTION_ID" => $GLOBALS["CATALOG_CURRENT_SECTION_ID"],
		"SECTION_CODE" => "",
		"SECTION_ELEMENT_ID" => $GLOBALS["CATALOG_CURRENT_ELEMENT_ID"],
		"SECTION_ELEMENT_CODE" => "",
		"DEPTH" => "2",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"DETAIL_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"PRICE_CODE" => array(
		),
		"SHOW_PRODUCTS_5" => "N",
		"PROPERTY_CODE_5" => array(
		),
		"CART_PROPERTIES_5" => array(
		),
		"ADDITIONAL_PICT_PROP_5" => "MORE_PHOTO",
		"SHOW_PRODUCTS_7" => "N",
		"PROPERTY_CODE_7" => array(
		),
		"CART_PROPERTIES_7" => array(
		),
		"ADDITIONAL_PICT_PROP_7" => "MORE_PHOTO",
		"PROPERTY_CODE_6" => array(
			0 => "",
			1 => "",
		),
		"CART_PROPERTIES_6" => array(
			0 => "",
			1 => "",
		),
		"ADDITIONAL_PICT_PROP_6" => "MORE_PHOTO",
		"OFFER_TREE_PROPS_6" => "",
		"PROPERTY_CODE_8" => array(
			0 => "",
			1 => "",
		),
		"CART_PROPERTIES_8" => array(
			0 => "",
			1 => "",
		),
		"ADDITIONAL_PICT_PROP_8" => "MORE_PHOTO",
		"OFFER_TREE_PROPS_8" => ""
	),
	false
); ?>
		</div><?
	}
}
else
{   
	echo "<p class='msg'>".$arResult["ERROR_MESSAGE"].".</p>";
}
?>
</div>
<div class="b_footer">
    <?$APPLICATION->ShowViewContent("BASKET_CHECKOUT");?>
</div>
<script>
    $(document).ready(function() {
        $("#basket .b_body").niceScroll({
            cursorcolor: "#00abdd",
            cursorborder: 0,
            cursorborderradius: 0,
            zindex: 999,
            cursoropacitymax: 0.7
        });
    });

    BX.ready(function() {

        basketPoolQuantity = new BasketPoolQuantity();
        var sku_props = BX.findChildren(BX('basket_items'), {tagName: 'li', className: 'sku_prop'}, true),
            i,
            couponBlock;
        if (!!sku_props && sku_props.length > 0)
        {
            for (i = 0; sku_props.length > i; i++)
            {
                BX.bind(sku_props[i], 'click', BX.delegate(function(e){ skuPropClickHandler(e);}, this));
            }
        }
        couponBlock = BX('coupons_block');
        if (!!couponBlock)
            BX.bindDelegate(couponBlock, 'click', { 'attribute': 'data-coupon' }, BX.delegate(function(e){deleteCoupon(e); }, this));

        if (basketJSParams['EVENT_ONCHANGE_ON_START'] && basketJSParams['EVENT_ONCHANGE_ON_START'] == "Y")
        {
            BX.onCustomEvent('OnBasketChange');
        }
    });
</script>