<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.mall") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.mall") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
if(\Bitrix\Main\Loader::includeModule('bxmaker.geoip'))
{


$city = $arResult['PROPERTIES']['CITY']['VALUE'];

if($arResult['PROPERTIES']['CITY']['VALUE'] || isset($_POST['LOCATION']))
{
    if(isset($_POST['LOCATION']))
    {
        $city = intval($_POST['LOCATION']);
    }
    ?>
    
    <?if($city):?>
     <?$APPLICATION->IncludeComponent("krayt:geoip.delivery", "delivery", Array(
    	"LOCATION" => intval($city),
    		"CACHE_TYPE" => "N",	// Тип кеширования
    	),
    	false
    );?>
     <?$APPLICATION->IncludeComponent("bxmaker:geoip.epilog", "", Array(
    		"CACHE_TYPE" => "N",	// Тип кеширования
    	),
    	false
    );?>

<?endif;?>
    
<?}}