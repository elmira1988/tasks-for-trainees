<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обучающие курсы");
?><?$APPLICATION->IncludeComponent(
	"bitrix:learning.course.list",
	"",
	Array(
		"CHECK_PERMISSIONS" => "Y",
		"COURSES_PER_PAGE" => "20",
		"COURSE_DETAIL_TEMPLATE" => "course.php?COURSE_ID=#COURSE_ID#&INDEX=Y",
		"SET_TITLE" => "Y",
		"SORBY" => "SORT",
		"SORORDER" => "ASC"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>