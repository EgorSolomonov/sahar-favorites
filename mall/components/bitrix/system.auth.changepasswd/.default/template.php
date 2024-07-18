<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.mall") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.mall") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}?>

<div class="wrapper">

    <?
    ShowMessage($arParams["~AUTH_RESULT"]);
    ?>
    <h1><?=GetMessage("AUTH_CHANGE_PASSWORD")?></h1>   
    <?$APPLICATION->IncludeComponent(
            "bitrix:system.auth.form",
            ".ajax",
            Array(
                    "FORGOT_PASSWORD_URL" => "",
                    "PROFILE_URL" => "/personal/",
                    "REGISTER_URL" => "/enter/",
                    "SHOW_ERRORS" => "Y",
                    "TYPE" => "ERROR"
            ),
            $component
    );?>
    <form method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform" class="changepsw-form">
        <?if (strlen($arResult["BACKURL"]) > 0): ?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <? endif ?>

        <input type="hidden" name="AUTH_FORM" value="Y">
        <input type="hidden" name="TYPE" value="CHANGE_PWD">

        <input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" class="input-text" placeholder="<?=GetMessage("AUTH_LOGIN")?>*" />
        <input type="text" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" class="input-text" placeholder="<?=GetMessage("AUTH_CHECKWORD")?>*" />
        <input type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" class="input-text" autocomplete="off" placeholder="<?=GetMessage("AUTH_NEW_PASSWORD_REQ")?>*" />
        <input type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="input-text" autocomplete="off" placeholder="<?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?>*" />
        <input type="submit" name="change_pwd" class="btn" value="<?=GetMessage("AUTH_CHANGE")?>" />

        <div class="changepsw-form__text">
            <p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
            <p><?=GetMessage("AUTH_REQ")?></p>
            <p>
                <a class="changepsw-form__link-enter" href="/enter/"><?=GetMessage("AUTH_AUTH")?></a>
            </p>
        </div>
    </form>
</div>