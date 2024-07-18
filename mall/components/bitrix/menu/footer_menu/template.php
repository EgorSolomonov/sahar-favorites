<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.mall") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.mall") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}?>
<?if (!empty($arResult)):?>
<ul>
    <?
    $previousLevel = 0;
    $menu_selected = 0;
foreach($arResult as $arItem):?>

    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
        <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
    <?endif?>

    <?if ($arItem["IS_PARENT"]):?>

    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
    <?
    if ($arItem["SELECTED"]) {
        $menu_selected = 1;
    }
    ?>
    <li style="position: relative"><a href="<?=$arItem["LINK"]?>" class="root-item <?if ($arItem["SELECTED"]):?>selected<?endif?>"><?=$arItem["TEXT"]?></a><div class="cat_block"></div>
    <ul>
    <?else:?>
    <li><a <?if ($arItem["SELECTED"]):?> class="selected"<?endif?> href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
    <ul>
    <?endif?>

    <?else:?>

        <?if ($arItem["PERMISSION"] > "D"):?>

            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                <li><a href="<?=$arItem["LINK"]?>" class="root-item <?if ($arItem["SELECTED"]):?>selected<?endif?>"><?=$arItem["TEXT"]?></a></li>
            <?else:?>
                <li><a <?if ($arItem["SELECTED"]):?> class="selected"<?endif?> href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
            <?endif?>

        <?else:?>

            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                <li><a href="" class="root-item <?if ($arItem["SELECTED"]):?>selected<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
            <?else:?>
                <li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
            <?endif?>

        <?endif?>

    <?endif?>

    <?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

    <?if ($previousLevel > 1)://close last item tags?>
        <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
    <?endif?>


</ul>
<?endif?>