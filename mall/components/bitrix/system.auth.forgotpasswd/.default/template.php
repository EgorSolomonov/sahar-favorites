<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.mall") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.mall") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}?><?

ShowMessage($arParams["~AUTH_RESULT"]);

?>
<form name="bform" id="enter__forgotpsw-form" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?
if (strlen($arResult["BACKURL"]) > 0)
{
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
}
?>
	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="SEND_PWD">
	<p>
	<?=GetMessage("AUTH_FORGOT_PASSWORD_1")?>
	</p>
        <div class="enter__forgotpsw-error"></div>
        <input type="text" class="input-text" name="USER_EMAIL" maxlength="255" placeholder="<?=GetMessage("AUTH_EMAIL")?>" />
        <input type="submit" class="btn" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" />
</form>
