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

if (0 < $arResult["SECTIONS_COUNT"])
{
?>
	<ul class="catalog-menu-mobile">
	<?
		foreach ($arResult['SECTIONS'] as &$arSection)
		{

			?><li ><a <?if($arParams['SECTION_CURRENT_ID'] == $arSection['ID']):?>class="selected"<?endif;?> href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a></li><?
		}
		unset($arSection);
	?>
	</ul>
<?
}
?>
<script>
	$(document).ready(function () {

		$(".catalog-menu-mobile").niceScroll({
			cursorcolor: "transparent",
			cursorborder: 0
		});
	});
</script>
