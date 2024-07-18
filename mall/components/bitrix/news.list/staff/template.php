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
?>
<div class="staff-block">
    <h2>Наши сотрудники</h2>
    <div class="staff-list">
        <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="staff-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <?if(is_array($arItem["PREVIEW_PICTURE"])):?>
                            <img
                                    src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                    alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                    title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                                    />
                        <?endif?>
                        <?echo $arItem["NAME"]?>
                </div>  
        <?endforeach;?>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".staff-list").niceScroll({
            cursorcolor: "#00abdd",
            cursorwidth: "3px",
            cursorborder: 0,
            cursorborderradius: 0,
            zindex: 10,
            cursoropacitymax: 0.7,
            autohidemode: false,
            background: 'rgba(0, 171, 221, 0.2)'
        });
    });
</script>
