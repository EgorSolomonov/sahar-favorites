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
if(\Bitrix\Main\Loader::includeModule('bxmaker.geoip'))
{
    $oManager = \Bxmaker\GeoIP\Manager::getInstance();

    if ($_POST['LOCATION']) {
        $oManager->selectLocation($_POST['LOCATION']);
        $oManager->saveCookie();
    }

$APPLICATION->SetTitle($oManager->getCity());

$iblock = CIBlock::GetByID($arParams['IBLOCK_ID'])->Fetch();


$str = str_replace("#CITY#",$oManager->getCity(),$iblock['DESCRIPTION']);
?>
<div style="margin-bottom: 20px;">
    <?echo $str;?>
</div>

 <?$APPLICATION->IncludeComponent("krayt:geoip.delivery", "", Array(
    	//"LOCATION" => intval($city),
    		"CACHE_TYPE" => "N",	// ��� �����������
    	),
    	$component
    );?>
<?}?>

<?php $APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_DIR . "include/default_text_dostavka.php")
); ?>
