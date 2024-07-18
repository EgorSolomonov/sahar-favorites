<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.mall") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.mall") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}?>

<?if($arResult["FORM_TYPE"] == "login"):?>

    <a href="<?=$arParams["REGISTER_URL"];?>"><?=GetMessage("AUTH_LOGIN_REGISTER");?></a>

<? else: ?>
    <a href="<?=$arResult['PROFILE_URL']?>"><?=GetMessage("AUTH_LK")?></a>
    <a href="<?=$APPLICATION->GetCurPageParam("logout=yes", Array("logout"))?>"><?=GetMessage("AUTH_LOGOUT_BUTTON")?></a>
<?endif?>
