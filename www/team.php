<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Команда");
?>

   <?php
   $APPLICATION->IncludeComponent(
       "bitrix:ui.toolbar",
       "",
       []
   );
   ?>
   

<?$APPLICATION->IncludeComponent(
	"bitrix:lists", 
	".default", 
	[
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"IBLOCK_TYPE_ID" => "team",
		"SEF_MODE" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"SEF_FOLDER" => "/",
		"SEF_URL_TEMPLATES" => [
			"lists" => "",
			"list" => "#list_id#/view/#section_id#/",
			"list_sections" => "#list_id#/edit/#section_id#/",
			"list_edit" => "#list_id#/edit/",
			"list_fields" => "#list_id#/fields/",
			"list_field_edit" => "#list_id#/field/#field_id#/",
			"list_element_edit" => "#list_id#/element/#section_id#/#element_id#/",
			"list_file" => "#list_id#/file/#section_id#/#element_id#/#field_id#/#file_id#/",
			"bizproc_log" => "#list_id#/bp_log/#document_state_id#/",
			"bizproc_workflow_start" => "#list_id#/bp_start/#element_id#/",
			"bizproc_task" => "#list_id#/bp_task/#section_id#/#element_id#/#task_id#/",
			"bizproc_workflow_admin" => "#list_id#/bp_list/",
			"bizproc_workflow_edit" => "#list_id#/bp_edit/#ID#/",
			"bizproc_workflow_vars" => "#list_id#/bp_vars/#ID#/",
			"bizproc_workflow_constants" => "#list_id#/bp_constants/#ID#/",
			"list_export_excel" => "#list_id#/excel/",
			"catalog_processes" => "catalog_processes/",
		]
	],
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>