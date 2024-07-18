<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("SOLANT_SORT_PANEL_COMPONENT_NAME_VALUE"),
	"DESCRIPTION" => GetMessage("SOLANT_SORT_PANEL_COMPONENT_DESCRIPTION_VALUE"),
	"ICON" => "/images/icon.gif",
	"SORT" => 100,
	"PATH" => array(
		"ID" => "solant",
		"SORT" => 500,
		"NAME" => GetMessage("SOLANT_SORT.PANEL_COMPONENTS_FOLDER_NAME"),
		"CHILD" => array(
			"ID" => GetMessage("SOLANT_SORT_PANEL_COMPONENT_TYPE_CONTENT_VALUE"),
			"NAME" => '',
			"SORT" => 500,
		)
	),
);