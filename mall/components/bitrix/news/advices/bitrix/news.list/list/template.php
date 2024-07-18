<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.mall") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.mall") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}?>
<?if(count($arResult["ITEMS"])>0):?>
	<div class="news-list">
		<b><?=$arResult["NAME"]?></b>
		<ul>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<li><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></li>
		<?endforeach;?>
		</ul>
	</div>
<?endif?>
