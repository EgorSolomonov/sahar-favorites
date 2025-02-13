<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>

<div class="bx-auth-profile">

<?ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
	ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>
<script type="text/javascript">
<!--
var opened_sections = [<?
$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
if (strlen($arResult["opened"]) > 0)
{
	echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
}
else
{
	$arResult["opened"] = "reg";
	echo "'reg'";
}
?>];
//-->

var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
</script>
<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
        <?=$arResult["BX_SESSION_CHECK"]?>
        <input type="hidden" name="lang" value="<?=LANG?>" />
        <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

        <input type="text" class="input-text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" placeholder="<?=GetMessage('NAME')?>*" />
        <input type="text" class="input-text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" placeholder="<?=GetMessage('LAST_NAME')?>*" />
        <input type="text" class="input-text" name="PERSONAL_PHONE" maxlength="50" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" placeholder="<?=GetMessage('USER_PHONE')?>" />
        <input type="text" class="input-text" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" placeholder="<?=GetMessage('EMAIL')?><?if($arResult["EMAIL_REQUIRED"]):?>*<?endif?>" />
        <input type="hidden" class="input-text" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" />
        <?if($arResult["arUser"]["EXTERNAL_AUTH_ID"] == ''):?>
            <h4 class="change_psw_title"><?=GetMessage("CHANGE_PSW")?>:</h4>
            <input type="password" class="input-text" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" placeholder="<?=GetMessage('NEW_PASSWORD')?>" />
            <input type="password" class="input-text" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" placeholder="<?=GetMessage('NEW_PASSWORD_CONFIRM')?>" />
        <?endif?>
    
        <?if($arResult["TIME_ZONE_ENABLED"] == true):?>
            <tr>
                    <td colspan="2" class="profile-header"><?echo GetMessage("main_profile_time_zones")?></td>
            </tr>
            <tr>
                    <td><?echo GetMessage("main_profile_time_zones_auto")?></td>
                    <td>
                            <select name="AUTO_TIME_ZONE" onchange="this.form.TIME_ZONE.disabled=(this.value != 'N')">
                                    <option value=""><?echo GetMessage("main_profile_time_zones_auto_def")?></option>
                                    <option value="Y"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "Y"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_yes")?></option>
                                    <option value="N"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "N"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_no")?></option>
                            </select>
                    </td>
            </tr>
            <tr>
                    <td><?echo GetMessage("main_profile_time_zones_zones")?></td>
                    <td>
                            <select name="TIME_ZONE"<?if($arResult["arUser"]["AUTO_TIME_ZONE"] <> "N") echo ' disabled="disabled"'?>>
                                <?foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name):?>
                                                                <option value="<?=htmlspecialcharsbx($tz)?>"<?=($arResult["arUser"]["TIME_ZONE"] == $tz? ' SELECTED="SELECTED"' : '')?>><?=htmlspecialcharsbx($tz_name)?></option>
                                <?endforeach?>
                            </select>
                    </td>
            </tr>
        <?endif?>
	<?if ($arResult["INCLUDE_LEARNING"] == "Y"):?>
	<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('learning')"><?=GetMessage("learning_INFO")?></a></div>
	<div id="user_div_learning" class="profile-block-<?=strpos($arResult["opened"], "learning") === false ? "hidden" : "shown"?>">
	<table class="data-table profile-table">
		<thead>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?=GetMessage("learning_PUBLIC_PROFILE");?>:</td>
				<td><input type="checkbox" name="student_PUBLIC_PROFILE" value="Y" <?if ($arResult["arStudent"]["PUBLIC_PROFILE"]=="Y") echo "checked=\"checked\"";?> /></td>
			</tr>
			<tr>
				<td><?=GetMessage("learning_RESUME");?>:</td>
				<td><textarea cols="30" rows="5" name="student_RESUME"><?=$arResult["arStudent"]["RESUME"]; ?></textarea></td>
			</tr>

			<tr>
				<td><?=GetMessage("learning_TRANSCRIPT");?>:</td>
				<td><?=$arResult["arStudent"]["TRANSCRIPT"];?>-<?=$arResult["ID"]?></td>
			</tr>
		</tbody>
	</table>
	</div>
	<?endif;?>
	<?// ********************* User properties ***************************************************?>
	<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('user_properties')"><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></a></div>
	<div id="user_div_user_properties" class="profile-block-<?=strpos($arResult["opened"], "user_properties") === false ? "hidden" : "shown"?>">
	<table class="data-table profile-table">
		<thead>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</thead>
		<tbody>
		<?$first = true;?>
		<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
		<tr><td class="field-name">
			<?if ($arUserField["MANDATORY"]=="Y"):?>
				<span class="starrequired">*</span>
			<?endif;?>
			<?=$arUserField["EDIT_FORM_LABEL"]?>:</td><td class="field-value">
				<?$APPLICATION->IncludeComponent(
					"bitrix:system.field.edit",
					$arUserField["USER_TYPE"]["USER_TYPE_ID"],
					array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
		<?endforeach;?>
		</tbody>
	</table>
	</div>
	<?endif;?>
	<?// ******************** /User properties ***************************************************?>
<!--	<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>-->
        <div class="btns">
            <input type="submit" name="save" class="btn" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">
            <input type="reset" class="btn btn_grey" value="<?=GetMessage('MAIN_RESET');?>">
        </div>
</form>
<?
/*if($arResult["SOCSERV_ENABLED"])
{
	$APPLICATION->IncludeComponent("bitrix:socserv.auth.split", ".default", array(
			"SHOW_PROFILES" => "Y",
			"ALLOW_DELETE" => "Y"
		),
		false
	);
}
*/?>
</div>
<script>
    $(document).ready(function()  {
       $("input[name*='PHONE']").mask("+7 (999) 999-99-99"); 
    });
</script>