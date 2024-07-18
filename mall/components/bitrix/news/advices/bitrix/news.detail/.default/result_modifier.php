<?
/*
 * Следующая/предыдущая новость
 */

// сортировку берем из параметров компонента, только их сначала нужно добавить в вызов компонента news.detail в файле detail.php
$arSort = array(
    $arParams["SORT_BY1"]=>$arParams["SORT_ORDER1"],
    $arParams["SORT_BY2"]=>$arParams["SORT_ORDER2"],
);

$arSelect = array(
    "ID",
    "NAME",
    "DETAIL_PAGE_URL"
);

$arFilter = array (
    "IBLOCK_ID" => $arResult["IBLOCK_ID"],
    //"SECTION_CODE" => $arParams["SECTION_CODE"],
    "ACTIVE" => "Y",
    "CHECK_PERMISSIONS" => "Y",
);

// выбирать будем по 1 соседу с каждой стороны от текущего
$arNavParams = array(
    "nPageSize" => 1,
    "nElementID" => $arResult["ID"],
);

// Выбиреам записи
$result = CIBlockElement::GetList($arSort, $arFilter, false, $arNavParams, $arSelect);
while ($res = $result -> GetNext()) {
   $arItems[] = $res;
}

// возвращается от 1го до 3х элементов в зависимости от наличия соседей, обрабатываем эту ситуацию
if(count($arItems)==3) {
   $arResult["NEXT"] = Array("NAME"=>$arItems[0]["NAME"], "URL"=>$arItems[0]["DETAIL_PAGE_URL"]);
   $arResult["PREVIOUS"] = Array("NAME"=>$arItems[2]["NAME"], "URL"=>$arItems[2]["DETAIL_PAGE_URL"]);
}
elseif(count($arItems)==2) {
    if($arItems[0]["ID"]!=$arResult["ID"]) {
        $arResult["NEXT"] = Array("NAME"=>$arItems[0]["NAME"], "URL"=>$arItems[0]["DETAIL_PAGE_URL"]);
    }
    else {
        $arResult["PREVIOUS"] = Array("NAME"=>$arItems[1]["NAME"], "URL"=>$arItems[1]["DETAIL_PAGE_URL"]);
    }
}


/*
 * Список других соседних советов
 */

// выбирать будем по 3 соседа с каждой стороны от текущего
$arNavParams2 = array(
    "nPageSize" => 3,
    "nElementID" => $arResult["ID"],
);

$result2 = CIBlockElement::GetList($arSort, $arFilter, false, $arNavParams2, $arSelect);
while ($res2 = $result2 -> GetNext()) {
   $arResult["ADVICES_LIST"][] = $res2;
}