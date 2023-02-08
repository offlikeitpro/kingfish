<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @global CMain $APPLICATION */
if (isset($arParams["USE_FILTER"]) && $arParams["USE_FILTER"]=="Y")
{
	$arParams["FILTER_NAME"] = trim($arParams["FILTER_NAME"]);
	if ($arParams["FILTER_NAME"] === '' || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
		$arParams["FILTER_NAME"] = "arrFilter";
}
else
	$arParams["FILTER_NAME"] = "";

//default gifts
if(empty($arParams['USE_GIFTS_SECTION']))
{
	$arParams['USE_GIFTS_SECTION'] = 'Y';
}
if(empty($arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT']))
{
	$arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT'] = 3;
}
if(empty($arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT']))
{
	$arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT'] = 4;
}
if(empty($arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT']))
{
	$arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'] = 4;
}

$arParams['ACTION_VARIABLE'] = (isset($arParams['ACTION_VARIABLE']) ? trim($arParams['ACTION_VARIABLE']) : 'action');
if ($arParams["ACTION_VARIABLE"] == '' || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["ACTION_VARIABLE"]))
	$arParams["ACTION_VARIABLE"] = "action";

$smartBase = ($arParams["SEF_URL_TEMPLATES"]["section"]? $arParams["SEF_URL_TEMPLATES"]["section"]: "#SECTION_ID#/");
$arDefaultUrlTemplates404 = array(
	"sections" => "",
	"section" => "#SECTION_ID#/",
	"element" => "#SECTION_ID#/#ELEMENT_ID#/",
	"compare" => "compare.php?action=COMPARE",
	"smart_filter" => $smartBase."filter/#SMART_FILTER_PATH#/apply/"
);

$arDefaultVariableAliases404 = array();

$arDefaultVariableAliases = array();

$arComponentVariables = array(
	"SECTION_ID",
	"SECTION_CODE",
	"ELEMENT_ID",
	"ELEMENT_CODE",
	"action",
);

if($arParams["SEF_MODE"] == "Y")
{
    // костыль для добавления в урл названия бренда

    $section = false;
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    $url = explode('/',$url[0]);
    $url = array_diff($url, array(''));

    if(count($url) > 1 ){
        $arParams["SEF_FOLDER"] = $arParams["SEF_FOLDER"].$url[2]."/";
        $section = true;

        // получаем id элемента бренда
        $arSelect = array("ID","NAME");
        $arFilter = array("=CODE" => $url, "ACTIVE" => "Y");
        $res = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, false, $arSelect);
        if ($ob = $res->fetch()) {
            $arParams['ID_BRAND'] = $ob['ID'];
            $nameBrand = $ob["NAME"];
        }
    }

// получаем элементы для построения главнs[ раздела разделов
    if (count($url) == 2 && !empty($arParams['ID_BRAND'])) {
        $section_id = array();

        $arSelect = array("ID", "NAME", 'IBLOCK_SECTION_ID');
        $arFilter = array('IBLOCK_ID' => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", "PROPERTY_BRAND" => $arParams['ID_BRAND']);
        $res = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, false, false);
        while ($ob = $res->fetch()) {
            if (!empty($ob['IBLOCK_SECTION_ID'])) {
                $section_id[$ob['IBLOCK_SECTION_ID']] = $ob['IBLOCK_SECTION_ID'];
            }
        }
        $arParams["CHARTER_SECTION_ID"] = $section_id;

        $APPLICATION->AddChainItem(GetMessage('TITLE_CHAIN_BRAND'), "/".$url[1]."/");
//        $APPLICATION->AddChainItem($nameBrand , "");
    }

    $arParams['NAME_BRAND'] = $nameBrand;


	$arVariables = array();

	$engine = new CComponentEngine($this);
	if (\Bitrix\Main\Loader::includeModule('iblock'))
	{
		$engine->addGreedyPart("#SECTION_CODE_PATH#");
		$engine->addGreedyPart("#SMART_FILTER_PATH#");
		$engine->setResolveCallback(array("CIBlockFindTools", "resolveComponentEngine"));
	}
	$arUrlTemplates = CComponentEngine::makeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams["SEF_URL_TEMPLATES"]);
	$arVariableAliases = CComponentEngine::makeComponentVariableAliases($arDefaultVariableAliases404, $arParams["VARIABLE_ALIASES"]);


	$componentPage = $engine->guessComponentPath(
		$arParams["SEF_FOLDER"],
		$arUrlTemplates,
		$arVariables
	);
//хлебные крошки для разделов
    if (count($url) == 3 && !empty($arParams['ID_BRAND'])) {
        $APPLICATION->AddChainItem(GetMessage('TITLE_CHAIN_BRAND'), "/" . $url[1] . "/");
        $APPLICATION->AddChainItem($nameBrand, "/" . $url[1] . "/" . $url[2] . "/");

//        $rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], '=CODE' => $arVariables['SECTION_CODE']), false, array("ID", "NAME"));
//        if ($arSection = $rsSections->Fetch()) {
//            $APPLICATION->AddChainItem($arSection['NAME'] . " " . $nameBrand, "");
//        }
    }
	if ($componentPage === "smart_filter")
		$componentPage = "section";

	if(!$componentPage && isset($_REQUEST["q"]))
		$componentPage = "search";

	$b404 = false;
	if(!$componentPage)
	{
		$componentPage = "sections";
		$b404 = true;
	}

	if($componentPage == "section")
	{
		if (isset($arVariables["SECTION_ID"]))
			$b404 |= (intval($arVariables["SECTION_ID"])."" !== $arVariables["SECTION_ID"]);
		else
			$b404 |= !isset($arVariables["SECTION_CODE"]);
	}

	if($b404 && CModule::IncludeModule('iblock'))
	{
		$folder404 = str_replace("\\", "/", $arParams["SEF_FOLDER"]);
		if ($folder404 != "/")
			$folder404 = "/".trim($folder404, "/ \t\n\r\0\x0B")."/";
		if (mb_substr($folder404, -1) == "/")
			$folder404 .= "index.php";

		if ($folder404 != $APPLICATION->GetCurPage(true))
		{
			\Bitrix\Iblock\Component\Tools::process404(
				""
				,($arParams["SET_STATUS_404"] === "Y")
				,($arParams["SET_STATUS_404"] === "Y")
				,($arParams["SHOW_404"] === "Y")
				,$arParams["FILE_404"]
			);
		}
	}

	if($componentPage == 'sections'){
        $componentPage = "newsList";
    }
	if($section){
        $componentPage = 'section';
    }

	CComponentEngine::initComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);
	$arResult = array(
		"FOLDER" => $arParams["SEF_FOLDER"],
		"URL_TEMPLATES" => $arUrlTemplates,
		"VARIABLES" => $arVariables,
		"ALIASES" => $arVariableAliases
	);
}
else
{
	$arVariables = array();

	$arVariableAliases = CComponentEngine::makeComponentVariableAliases($arDefaultVariableAliases, $arParams["VARIABLE_ALIASES"]);
	CComponentEngine::initComponentVariables(false, $arComponentVariables, $arVariableAliases, $arVariables);

	$componentPage = "";

	$arCompareCommands = array(
		"COMPARE",
		"DELETE_FEATURE",
		"ADD_FEATURE",
		"DELETE_FROM_COMPARE_RESULT",
		"ADD_TO_COMPARE_RESULT",
		"COMPARE_BUY",
		"COMPARE_ADD2BASKET"
	);

	if(isset($arVariables["action"]) && in_array($arVariables["action"], $arCompareCommands))
		$componentPage = "compare";
	elseif(isset($arVariables["ELEMENT_ID"]) && intval($arVariables["ELEMENT_ID"]) > 0)
		$componentPage = "element";
	elseif(isset($arVariables["ELEMENT_CODE"]) && $arVariables["ELEMENT_CODE"] <> '')
		$componentPage = "element";
	elseif(isset($arVariables["SECTION_ID"]) && intval($arVariables["SECTION_ID"]) > 0)
		$componentPage = "section";
	elseif(isset($arVariables["SECTION_CODE"]) && $arVariables["SECTION_CODE"] <> '')
		$componentPage = "section";
	elseif(isset($_REQUEST["q"]))
		$componentPage = "search";
	else
		$componentPage = "sections";

	$currentPage = htmlspecialcharsbx($APPLICATION->GetCurPage())."?";
	$arResult = array(
		"FOLDER" => "",
		"URL_TEMPLATES" => array(
			"section" => $currentPage.$arVariableAliases["SECTION_ID"]."=#SECTION_ID#",
			"element" => $currentPage.$arVariableAliases["SECTION_ID"]."=#SECTION_ID#"."&".$arVariableAliases["ELEMENT_ID"]."=#ELEMENT_ID#",
			"compare" => $currentPage."action=COMPARE",
		),
		"VARIABLES" => $arVariables,
		"ALIASES" => $arVariableAliases
	);
}

$this->IncludeComponentTemplate($componentPage);