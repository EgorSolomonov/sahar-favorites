<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.mall") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.mall") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arTemplateParameters = Array(
	"SUPPRESS_ERRORS" => Array(
		"NAME" => Loc::getMessage("SALE_SLS_SUPPRESS_ERRORS_PARAMETER"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N"
	),
	"INITIALIZE_BY_GLOBAL_EVENT" => Array(
		"NAME" => Loc::getMessage("SALE_SLS_INITIALIZE_BY_GLOBAL_EVENT_PARAMETER"),
		"TYPE" => "STRING",
		"DEFAULT" => ""
	)
);