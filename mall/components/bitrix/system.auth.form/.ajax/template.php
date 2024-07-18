<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.mall") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.mall") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}?>
<?
if($arParams["TYPE"] == "ERROR") {
    ShowMessage($arResult['ERROR_MESSAGE']);
}
else {
    echo Bitrix\Main\Web\Json::encode($arResult['ERROR_MESSAGE']);
}