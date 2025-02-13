<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
?>
<h2><?=GetMessage("AUTH_REGISTER")?></h2>
<h4><?php echo GetMessage("REG_TEXT"); ?></h4>

<form method="post" class="enter__reg-form" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
<?
if (count($arResult["ERRORS"]) > 0):
	foreach ($arResult["ERRORS"] as $key => $error)
		if (intval($key) == 0 && $key !== 0) 
			$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

	ShowError(implode("<br />", $arResult["ERRORS"]));

elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
?>
<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
<?endif?>
    <?
if($arResult["BACKURL"] <> ''):
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
endif;
?>
<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
	<?
        switch ($FIELD)
	{   case "LOGIN":
        ?><input type="text" name="REGISTER[LOGIN]" class="input-text" placeholder="<?=GetMessage("REGISTER_FIELD_".$FIELD)?><?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>*<?endif?>"><?
    break;
		case "PASSWORD":
                    ?><input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="input-text" placeholder='<?=GetMessage("REGISTER_FIELD_".$FIELD)?><?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>*<?endif?>' />
<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure').style.display = 'inline-block';
</script>
<?endif?>
<?
			break;
		case "CONFIRM_PASSWORD":
                    ?><input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="input-text" placeholder='<?=GetMessage("REGISTER_FIELD_".$FIELD)?><?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>*<?endif?>' /><?
			break;
		case "PERSONAL_GENDER":
			?><select name="REGISTER[<?=$FIELD?>]">
				<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
				<option value="M"<?=$arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_MALE")?></option>
				<option value="F"<?=$arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
			</select><?
			break;

		case "PERSONAL_COUNTRY":
		case "WORK_COUNTRY":
			?><select name="REGISTER[<?=$FIELD?>]"><?
			foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value)
			{
				?><option value="<?=$value?>"<?if ($value == $arResult["VALUES"][$FIELD]):?> selected="selected"<?endif?>><?=$arResult["COUNTRIES"]["reference"][$key]?></option>
			<?
			}
			?></select><?
			break;

		case "PERSONAL_PHOTO":
		case "WORK_LOGO":
			?><input size="30" type="file" name="REGISTER_FILES_<?=$FIELD?>" /><?
			break;

		case "PERSONAL_NOTES":
		case "WORK_NOTES":
			?><textarea cols="30" rows="5" name="REGISTER[<?=$FIELD?>]"><?=$arResult["VALUES"][$FIELD]?></textarea><?
			break;
		default:
			if ($FIELD == "PERSONAL_BIRTHDAY"):?><small><?=$arResult["DATE_FORMAT"]?></small><br /><?endif;
                        ?><input size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" class="input-text" placeholder='<?=GetMessage("REGISTER_FIELD_".$FIELD)?><?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>*<?endif?>' /><?
				if ($FIELD == "PERSONAL_BIRTHDAY")
					$APPLICATION->IncludeComponent(
						'bitrix:main.calendar',
						'',
						array(
							'SHOW_INPUT' => 'N',
							'FORM_NAME' => 'regform',
							'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
							'SHOW_TIME' => 'N'
						),
						null,
						array("HIDE_ICONS"=>"Y")
					);
				?><?
	}?>
<?endforeach?>
<?// ********************* User properties ***************************************************?>
<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<tr><td colspan="2"><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></td></tr>
	<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
	<tr><td><?=$arUserField["EDIT_FORM_LABEL"]?>:<?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;?></td><td>
			<?$APPLICATION->IncludeComponent(
				"bitrix:system.field.edit",
				$arUserField["USER_TYPE"]["USER_TYPE_ID"],
				array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
	<?endforeach;?>
<?endif;?>
<?// ******************** /User properties ***************************************************?>
    <?
    /* CAPTCHA */
    if ($arResult["USE_CAPTCHA"] == "Y")
    {
        ?>
        <div class="captcha">
            <b><?=GetMessage("REGISTER_CAPTCHA_TITLE")?></b>
            <span>
                <input class="" type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
            </span>
        </div>
        <div>
            <input autocomplete="off" placeholder="<?=GetMessage("REGISTER_CAPTCHA_PROMT")?>" type="text" class="input-text" name="captcha_word" maxlength="50" value="" /
        </div>
        <?
    }
    /* !CAPTCHA */
    ?>

        <div class="required-fields">* <?=GetMessage("AUTH_REQ")?></div>
<input type="submit" name="register_submit_button" class="btn btn_blue" value="<?=GetMessage("AUTH_REGISTER")?>" />

</form>
<script>
    $(document).ready(function()  {
       $("input[name*='PHONE']").mask("+7 (999) 999-99-99"); 
    });
</script>