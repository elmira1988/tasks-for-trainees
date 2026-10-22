<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Курс");
?><?$APPLICATION->IncludeComponent(
	"bitrix:learning.course", 
	".default", 
	[
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_PERMISSIONS" => "Y",
		"COURSE_ID" => $_REQUEST["COURSE_ID"],
		"PAGE_NUMBER_VARIABLE" => "PAGE",
		"PAGE_WINDOW" => "10",
		"PATH_TO_USER_PROFILE" => "/company/personal/user/#USER_ID#/",
		"SEF_MODE" => "N",
		"SET_TITLE" => "Y",
		"SHOW_TIME_LIMIT" => "Y",
		"TESTS_PER_PAGE" => "20",
		"COMPONENT_TEMPLATE" => ".default",
		"VARIABLE_ALIASES" => [
			"COURSE_ID" => "COURSE_ID",
			"INDEX" => "INDEX",
			"LESSON_ID" => "LESSON_ID",
			"CHAPTER_ID" => "CHAPTER_ID",
			"SELF_TEST_ID" => "SELF_TEST_ID",
			"TEST_ID" => "TEST_ID",
			"TYPE" => "TYPE",
			"TEST_LIST" => "TEST_LIST",
			"GRADEBOOK" => "GRADEBOOK",
			"FOR_TEST_ID" => "FOR_TEST_ID",
		]
	],
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>