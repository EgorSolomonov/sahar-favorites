<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (
	\Bitrix\Main\Loader::includeSharewareModule("krayt.mall") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED ||
	\Bitrix\Main\Loader::includeSharewareModule("krayt.mall") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
) {
	return false;
}

use Bitrix\Main\Loader,
	Bitrix\Main\ModuleManager;
?>

<div class="no-gutters">

	<? if ($isFilter || $isSidebar) : ?>
		<div class="col-md-2 col-sm-4  krayt_filter_block krayt_filter_block_active" style="padding: 0;">
			<? if ($isFilter) : ?>
				<div class="bx-sidebar-block">
					<? $APPLICATION->IncludeComponent(
						"bitrix:catalog.smart.filter",
						"",
						array(
							"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
							"IBLOCK_ID" => $arParams["IBLOCK_ID"],
							"SECTION_ID" => $arCurSection['ID'],
							"FILTER_NAME" => $arParams["FILTER_NAME"],
							"PRICE_CODE" => $arParams["PRICE_CODE"],
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
							"SAVE_IN_SESSION" => "N",
							"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
							"XML_EXPORT" => "Y",
							"SECTION_TITLE" => "NAME",
							"SECTION_DESCRIPTION" => "DESCRIPTION",
							'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
							"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
							'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
							'CURRENCY_ID' => $arParams['CURRENCY_ID'],
							"SEF_MODE" => $arParams["SEF_MODE"],
							"SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],
							"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
							"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
							"INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
						),
						$component,
						array('HIDE_ICONS' => 'Y')
					); ?>
				</div>
			<? endif;
			if ($isSidebar) : ?>
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => $arParams["SIDEBAR_PATH"],
						"AREA_FILE_RECURSIVE" => "N",
						"EDIT_MODE" => "html",
					),
					false,
					array('HIDE_ICONS' => 'Y')
				); ?>
			<? endif ?>
		</div>
	<? endif ?>
	<div class="blo blo_active"></div>
	<div class="<?= (($isFilter || $isSidebar) ? "col-md-9 col-sm-8" : "col-xs-12") ?> krayt_content_block krayt_content_block_active">
		<div class="row">
			<div class="col-xs-12" style="padding: 0;">
				<?
				if (ModuleManager::isModuleInstalled("sale")) {
					$arRecomData = array();
					$recomCacheID = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);
					$obCache = new CPHPCache();
					if ($obCache->InitCache(36000, serialize($recomCacheID), "/sale/bestsellers")) {
						$arRecomData = $obCache->GetVars();
					} elseif ($obCache->StartDataCache()) {
						if (Loader::includeModule("catalog")) {
							$arSKU = CCatalogSKU::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
							$arRecomData['OFFER_IBLOCK_ID'] = (!empty($arSKU) ? $arSKU['IBLOCK_ID'] : 0);
						}
						$obCache->EndDataCache($arRecomData);
					}

					if (!empty($arRecomData) && $arParams['USE_GIFTS_SECTION'] === 'Y') {
						$APPLICATION->IncludeComponent(
							"bitrix:sale.gift.section",
							".default",
							array(
								"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
								"PRODUCT_SUBSCRIPTION" => $arParams['PRODUCT_SUBSCRIPTION'],
								"SHOW_NAME" => "Y",
								"SHOW_IMAGE" => "Y",
								"MESS_BTN_BUY" => $arParams['MESS_BTN_BUY'],
								"MESS_BTN_DETAIL" => $arParams['MESS_BTN_DETAIL'],
								"MESS_NOT_AVAILABLE" => $arParams['MESS_NOT_AVAILABLE'],
								"MESS_BTN_SUBSCRIBE" => $arParams['MESS_BTN_SUBSCRIBE'],
								"TEMPLATE_THEME" => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
								"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
								"CACHE_TYPE" => $arParams["CACHE_TYPE"],
								"CACHE_TIME" => $arParams["CACHE_TIME"],
								"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
								"FILTER_NAME" => $arParams["FILTER_NAME"],
								"ORDER_FILTER_NAME" => "arOrderFilter",
								"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
								"PRICE_CODE" => $arParams["PRICE_CODE"],
								"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
								"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
								"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
								"CURRENCY_ID" => $arParams["CURRENCY_ID"],
								"BASKET_URL" => $arParams["BASKET_URL"],
								"ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action") . '_sgs',
								"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
								"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
								"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
								"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
								"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
								"USE_PRODUCT_QUANTITY" => 'N',
								"SHOW_PRODUCTS_" . $arParams["IBLOCK_ID"] => "Y",
								"OFFER_TREE_PROPS_" . $arRecomData['OFFER_IBLOCK_ID'] => $arParams["OFFER_TREE_PROPS"],
								"ADDITIONAL_PICT_PROP_" . $arParams['IBLOCK_ID'] => $arParams['ADD_PICT_PROP'],
								"ADDITIONAL_PICT_PROP_" . $arRecomData['OFFER_IBLOCK_ID'] => $arParams['OFFER_ADD_PICT_PROP'],

								"SHOW_DISCOUNT_PERCENT" => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
								"SHOW_OLD_PRICE" => $arParams['GIFTS_SHOW_OLD_PRICE'],
								"TEXT_LABEL_GIFT" => $arParams['GIFTS_SECTION_LIST_TEXT_LABEL_GIFT'],
								"HIDE_BLOCK_TITLE" => $arParams['GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE'],
								"BLOCK_TITLE" => $arParams['GIFTS_SECTION_LIST_BLOCK_TITLE'],
								"PAGE_ELEMENT_COUNT" => $arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT'],
								"LINE_ELEMENT_COUNT" => $arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT'],

								"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
								"IBLOCK_ID" => $arParams["IBLOCK_ID"],
							)
								+ array(
									"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
									"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
									"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
									"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
								),
							$component,
							array("HIDE_ICONS" => "Y")
						);
					}
				}
				?>
			</div>
			<div class="col-xs-12" style="padding: 0;">
				<? $APPLICATION->IncludeComponent(
					"bitrix:catalog.section.list",
					"",
					array(
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
						"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
						"CACHE_TYPE" => $arParams["CACHE_TYPE"],
						"CACHE_TIME" => $arParams["CACHE_TIME"],
						"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
						"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
						"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
						"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
						"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
						"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
						"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
						"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
					),
					$component,
					array("HIDE_ICONS" => "Y")
				); ?><?
						if ($arParams["USE_COMPARE"] == "Y") {
						?><? $APPLICATION->IncludeComponent(
								"bitrix:catalog.compare.list",
								"",
								array(
									"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
									"IBLOCK_ID" => $arParams["IBLOCK_ID"],
									"NAME" => $arParams["COMPARE_NAME"],
									"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
									"COMPARE_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["compare"],
									"ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action") . "_ccl",
									"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
									'POSITION_FIXED' => isset($arParams['COMPARE_POSITION_FIXED']) ? $arParams['COMPARE_POSITION_FIXED'] : '',
									'POSITION' => isset($arParams['COMPARE_POSITION']) ? $arParams['COMPARE_POSITION'] : ''
								),
								$component,
								array("HIDE_ICONS" => "Y")
							); ?><?
								}

								if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
									$basketAction = (isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '');
								else
									$basketAction = (isset($arParams['SECTION_ADD_TO_BASKET_ACTION']) ? $arParams['SECTION_ADD_TO_BASKET_ACTION'] : '');

								$intSectionID = 0;
									?>
				<?
				global $APPLICATION;
				//set filter
				if (!empty($_REQUEST['sort'])) {
					$section_sort = $_REQUEST['sort'];

					switch ($section_sort) {
						case 'price':
							$arParams["ELEMENT_SORT_FIELD"] = 'CATALOG_PRICE_1';
							$arParams["ELEMENT_SORT_ORDER"] = 'desc';
							break;
						case 'new':
							$arParams["ELEMENT_SORT_FIELD"] = 'timestamp_x';
							$arParams["ELEMENT_SORT_ORDER"] = 'desc';
							break;
						case 'popular':
							$arParams["ELEMENT_SORT_FIELD"] = 'show_counter';
							$arParams["ELEMENT_SORT_ORDER"] = 'desc';
							break;
					}
				}

				?>
				<div class="catalog_filter_box">
					<span><?= GetMessage('FILTER_SORTBY'); ?>:</span>
					<a href="<?= ($section_sort != "price") ? $APPLICATION->GetCurPageParam("sort=price", array("sort")) : $APPLICATION->GetCurPageParam("", array("sort")); ?>" <? if ($section_sort == "price") : ?>class="active" <? endif; ?>><?= GetMessage('FILTER_PRICE_DESC'); ?></a>
					<a href="<?= ($section_sort != "new") ? $APPLICATION->GetCurPageParam("sort=new", array("sort")) : $APPLICATION->GetCurPageParam("", array("sort")); ?>" <? if ($section_sort == "new") : ?>class="active" <? endif; ?>><?= GetMessage('FILTER_NEW'); ?></a>
					<a href="<?= ($section_sort != "popular") ? $APPLICATION->GetCurPageParam("sort=popular", array("sort")) : $APPLICATION->GetCurPageParam("", array("sort")); ?>" <? if ($section_sort == "popular") : ?>class="active" <? endif; ?>><?= GetMessage('FILTER_POPULAR'); ?></a>
				</div>
				<? $intSectionID = $APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					"",
					array(
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
						"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
						"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
						"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
						"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
						"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
						"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
						"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
						"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
						"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
						"BASKET_URL" => $arParams["BASKET_URL"],
						"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
						"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
						"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
						"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
						"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
						"FILTER_NAME" => $arParams["FILTER_NAME"],
						"CACHE_TYPE" => $arParams["CACHE_TYPE"],
						"CACHE_TIME" => $arParams["CACHE_TIME"],
						"CACHE_FILTER" => $arParams["CACHE_FILTER"],
						"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
						"SET_TITLE" => $arParams["SET_TITLE"],
						"MESSAGE_404" => $arParams["MESSAGE_404"],
						"SET_STATUS_404" => $arParams["SET_STATUS_404"],
						"SHOW_404" => $arParams["SHOW_404"],
						"FILE_404" => $arParams["FILE_404"],
						"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
						"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
						"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
						"PRICE_CODE" => $arParams["PRICE_CODE"],
						"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
						"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

						"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
						"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
						"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
						"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
						"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

						"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
						"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
						"PAGER_TITLE" => $arParams["PAGER_TITLE"],
						"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
						"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
						"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
						"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
						"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
						"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
						"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
						"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

						"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
						"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
						"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
						"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
						"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
						"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
						"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
						"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

						"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
						"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
						"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
						"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
						"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
						'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
						'CURRENCY_ID' => $arParams['CURRENCY_ID'],
						'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

						'LABEL_PROP' => $arParams['LABEL_PROP'],
						'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
						'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

						'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
						'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
						'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
						'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
						'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
						'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
						'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
						'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
						'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
						'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

						'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
						"ADD_SECTIONS_CHAIN" => "N",
						'ADD_TO_BASKET_ACTION' => $basketAction,
						'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
						'COMPARE_PATH' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
						'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
						'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
					),
					$component
				); ?>
			</div>
			<?
			$GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID;
			unset($basketAction);

			if (ModuleManager::isModuleInstalled("sale")) {
				if (!empty($arRecomData)) {
					if (!isset($arParams['USE_SALE_BESTSELLERS']) || $arParams['USE_SALE_BESTSELLERS'] != 'N') {
			?>
						<div class="col-xs-12" style="padding: 0;">
							<? $APPLICATION->IncludeComponent(
								"bitrix:sale.bestsellers",
								"",
								array(
									"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
									"PAGE_ELEMENT_COUNT" => "5",
									"SHOW_DISCOUNT_PERCENT" => $arParams['SHOW_DISCOUNT_PERCENT'],
									"PRODUCT_SUBSCRIPTION" => $arParams['PRODUCT_SUBSCRIPTION'],
									"SHOW_NAME" => "Y",
									"SHOW_IMAGE" => "Y",
									"MESS_BTN_BUY" => $arParams['MESS_BTN_BUY'],
									"MESS_BTN_DETAIL" => $arParams['MESS_BTN_DETAIL'],
									"MESS_NOT_AVAILABLE" => $arParams['MESS_NOT_AVAILABLE'],
									"MESS_BTN_SUBSCRIBE" => $arParams['MESS_BTN_SUBSCRIBE'],
									"LINE_ELEMENT_COUNT" => 5,
									"TEMPLATE_THEME" => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
									"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
									"CACHE_TYPE" => $arParams["CACHE_TYPE"],
									"CACHE_TIME" => $arParams["CACHE_TIME"],
									"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
									"BY" => array(
										0 => "AMOUNT",
									),
									"PERIOD" => array(
										0 => "15",
									),
									"FILTER" => array(
										0 => "CANCELED",
										1 => "ALLOW_DELIVERY",
										2 => "PAYED",
										3 => "DEDUCTED",
										4 => "N",
										5 => "P",
										6 => "F",
									),
									"FILTER_NAME" => $arParams["FILTER_NAME"],
									"ORDER_FILTER_NAME" => "arOrderFilter",
									"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
									"SHOW_OLD_PRICE" => $arParams['SHOW_OLD_PRICE'],
									"PRICE_CODE" => $arParams["PRICE_CODE"],
									"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
									"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
									"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
									"CURRENCY_ID" => $arParams["CURRENCY_ID"],
									"BASKET_URL" => $arParams["BASKET_URL"],
									"ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action") . "_slb",
									"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
									"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
									"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
									"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
									"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
									"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
									"SHOW_PRODUCTS_" . $arParams["IBLOCK_ID"] => "Y",
									"OFFER_TREE_PROPS_" . $arRecomData['OFFER_IBLOCK_ID'] => $arParams["OFFER_TREE_PROPS"],
									"ADDITIONAL_PICT_PROP_" . $arParams['IBLOCK_ID'] => $arParams['ADD_PICT_PROP'],
									"ADDITIONAL_PICT_PROP_" . $arRecomData['OFFER_IBLOCK_ID'] => $arParams['OFFER_ADD_PICT_PROP']
								),
								$component,
								array("HIDE_ICONS" => "Y")
							); ?>
						</div>
					<?
					}
					if (!isset($arParams['USE_BIG_DATA']) || $arParams['USE_BIG_DATA'] != 'N') {
					?>
						<div class="col-xs-12" style="padding: 0;">
							<? $APPLICATION->IncludeComponent(
								"bitrix:catalog.bigdata.products",
								"",
								array(
									"LINE_ELEMENT_COUNT" => 5,
									"TEMPLATE_THEME" => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
									"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
									"BASKET_URL" => $arParams["BASKET_URL"],
									"ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action") . "_cbdp",
									"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
									"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
									"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
									"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
									"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
									"SHOW_OLD_PRICE" => $arParams['SHOW_OLD_PRICE'],
									"SHOW_DISCOUNT_PERCENT" => $arParams['SHOW_DISCOUNT_PERCENT'],
									"PRICE_CODE" => $arParams["PRICE_CODE"],
									"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
									"PRODUCT_SUBSCRIPTION" => $arParams['PRODUCT_SUBSCRIPTION'],
									"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
									"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
									"SHOW_NAME" => "Y",
									"SHOW_IMAGE" => "Y",
									"MESS_BTN_BUY" => $arParams['MESS_BTN_BUY'],
									"MESS_BTN_DETAIL" => $arParams['MESS_BTN_DETAIL'],
									"MESS_BTN_SUBSCRIBE" => $arParams['MESS_BTN_SUBSCRIBE'],
									"MESS_NOT_AVAILABLE" => $arParams['MESS_NOT_AVAILABLE'],
									"PAGE_ELEMENT_COUNT" => 5,
									"SHOW_FROM_SECTION" => "Y",
									"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
									"IBLOCK_ID" => $arParams["IBLOCK_ID"],
									"DEPTH" => "2",
									"CACHE_TYPE" => $arParams["CACHE_TYPE"],
									"CACHE_TIME" => $arParams["CACHE_TIME"],
									"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
									"SHOW_PRODUCTS_" . $arParams["IBLOCK_ID"] => "Y",
									"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
									"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
									"CURRENCY_ID" => $arParams["CURRENCY_ID"],
									"SECTION_ID" => $intSectionID,
									"SECTION_CODE" => "",
									"SECTION_ELEMENT_ID" => "",
									"SECTION_ELEMENT_CODE" => "",
									"LABEL_PROP_" . $arParams["IBLOCK_ID"] => $arParams['LABEL_PROP'],
									"PROPERTY_CODE_" . $arParams["IBLOCK_ID"] => $arParams["LIST_PROPERTY_CODE"],
									"PROPERTY_CODE_" . $arRecomData['OFFER_IBLOCK_ID'] => $arParams["LIST_OFFERS_PROPERTY_CODE"],
									"CART_PROPERTIES_" . $arParams["IBLOCK_ID"] => $arParams["PRODUCT_PROPERTIES"],
									"CART_PROPERTIES_" . $arRecomData['OFFER_IBLOCK_ID'] => $arParams["OFFERS_CART_PROPERTIES"],
									"ADDITIONAL_PICT_PROP_" . $arParams["IBLOCK_ID"] => $arParams['ADD_PICT_PROP'],
									"ADDITIONAL_PICT_PROP_" . $arRecomData['OFFER_IBLOCK_ID'] => $arParams['OFFER_ADD_PICT_PROP'],
									"OFFER_TREE_PROPS_" . $arRecomData['OFFER_IBLOCK_ID'] => $arParams["OFFER_TREE_PROPS"],
									"RCM_TYPE" => (isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '')
								),
								$component,
								array("HIDE_ICONS" => "Y")
							); ?>
						</div>
			<?
					}
				}
			}
			?>
		</div>
	</div>

</div>