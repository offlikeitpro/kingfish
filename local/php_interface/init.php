<?
define("IBLOCK_SKU", 44);
define("IBLOCK_BRANDS_SEO", 50);
if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/local/include/import/autoload.php")) {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/local/include/import/autoload.php");
}
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
//@include('include/1cexchange.php');
AddEventHandler("search", "BeforeIndex", "BeforeIndexHandler");
function BeforeIndexHandler($arFields)
{
    $arrIblock = array(24, 43);
    //   $arDelFields = array("DETAIL_TEXT", "PREVIEW_TEXT");
    if (CModule::IncludeModule('iblock') && $arFields["MODULE_ID"] == 'iblock' && in_array($arFields["PARAM2"], $arrIblock) && intval($arFields["ITEM_ID"]) > 0) {
        /*   $dbElement = CIblockElement::GetByID($arFields["ITEM_ID"]);
           if ($arElement = $dbElement->Fetch()) {
               foreach ($arDelFields as $value) {
                   if (isset ($arElement[$value]) && strlen($arElement[$value]) > 0) {
                       $arFields["BODY"] = str_replace(CSearch::KillTags($arElement[$value]), "", CSearch::KillTags($arFields["BODY"]));
                   }
               }
           }*/

        #Данное действие отменяет поиск элементов по свойства, а устанавливает в общий контен только поиск по названию.!!!!!!!!!!!!!!!!!!!!!!!!!!
        $arFields["BODY"] = $arFields["TITLE"];
    }
    return $arFields;
}

AddEventHandler("sale", "OnOrderSave", "setCashBackPriceOrder"); //меняем стоимсоть оплаты
function setCashBackPriceOrder($orderId, $fields, $arFields, $isNew)
{
    if ($isNew) {
        $arEventFields = array(
            "ORDER_ID" => $orderId,
        );
        CEvent::Send("NEW_ORDER_ADMIN", "s1", $arEventFields);
    }
}


AddEventHandler("catalog", "OnBeforeProductUpdate", "notInStore");
function notInStore($ID, &$arFields)
{
    if ($_REQUEST['mode'] == 'import') {
        $ar_props = array();
        $db_props = CIBlockElement::GetProperty(IBLOCK_SKU, $ID, array("sort" => "asc"), Array("CODE" => "NO_QUANTITY"));
        $ar_props = $db_props->Fetch();
        if ($ar_props["VALUE_ENUM"] == "Y")
            unset($arFields["QUANTITY"]);

    }
}
AddEventHandler('catalog', 'OnCompleteCatalogImport1C', 'OnBeforeAllPriceUpdateHandler2');
function OnBeforeAllPriceUpdateHandler2()
{
    CModule::IncludeModule("highloadblock");
    $hlbl = 4;
    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();// get entity
    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    $res_hl = $entity_data_class::getList(array('filter' => array('ID' => 2)));
    if ($item = $res_hl->fetch()) {
        $array_id_hl = json_decode($item['UF_ID_JSON']);
    }
    $arSelect = Array("ID");
    $arFilter = Array("IBLOCK_ID"=>43,"!ID"=>$array_id_hl,"ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $el = new CIBlockElement;
        $arLoadProductArray = Array("ACTIVE" => "N");
        $res_deact = $el->Update($arFields["ID"], $arLoadProductArray);
    }
    $entity_data_class::update(2, array(
        'UF_ID_JSON' => "",
    ));
}

//очистка кэша при изменении правил работы с корзиной
$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandlerCompatible(
    'main', 'OnEpilog',
    function () {
        if (strpos($_SERVER["SCRIPT_FILENAME"], 'sale_discount_preset_detail.php') !== false) {
            if ($_POST["save"] == 'Y') {
                BXClearCache(true, '/s1');
                $managed_cache = new \Bitrix\Main\Data\ManagedCache();
                $cl = $managed_cache->cleanAll();
            }
        }

        if (strpos($_SERVER["SCRIPT_FILENAME"], 'sale_discount.php') !== false) {
            if ($_POST["action_button_tbl_sale_discount"] == 'activate' || $_POST["action_button_tbl_sale_discount"] == 'deactivate') {
                BXClearCache(true, '/s1');
                $managed_cache = new \Bitrix\Main\Data\ManagedCache();
                $cl = $managed_cache->cleanAll();
            }
        }
    }
);

// SEO для раздела брендов
AddEventHandler("main", "OnEpilog", "InitMetaForEmptySeoByURL");
function InitMetaForEmptySeoByURL()
{
    global $APPLICATION;
    if (strripos($APPLICATION->GetCurPage(), '/brands/') !== false) {
        $arSelect = array("ID", "NAME", "PROPERTY_SEO_H1", "PROPERTY_TITLE", "PROPERTY_DESCRIPTION", "PROPERTY_TEXT_DESCRIPTION", "PROPERTY_CHAINITEM", "PROPERTY_KEYWORDS");
        $arFilter = array("IBLOCK_ID" => IBLOCK_BRANDS_SEO, "ACTIVE_DATE" => "Y", "NAME" => $APPLICATION->GetCurPage());
        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        if ($ob = $res->Fetch()) {
            if (!empty($ob['PROPERTY_SEO_H1_VALUE']['TEXT'])) {
                $APPLICATION->SetTitle($ob['PROPERTY_SEO_H1_VALUE']['TEXT']);
            }
            if (!empty($ob['PROPERTY_TITLE_VALUE']['TEXT'])) {
                $APPLICATION->SetPageProperty('title', $ob['PROPERTY_TITLE_VALUE']['TEXT']);
            }
            if (!empty($ob['PROPERTY_DESCRIPTION_VALUE']['TEXT'])) {
                $APPLICATION->SetPageProperty('description', $ob['PROPERTY_DESCRIPTION_VALUE']['TEXT']);
            }
            if (!empty($ob['PROPERTY_KEYWORDS_VALUE']['TEXT'])) {
                $APPLICATION->SetPageProperty('keywords', $ob['PROPERTY_KEYWORDS_VALUE']['TEXT']);
            }
            if (!empty($ob['PROPERTY_CHAINITEM_VALUE'])) {
                $APPLICATION->AddChainItem($ob['PROPERTY_CHAINITEM_VALUE'], "");
            }
            if (!empty($ob['PROPERTY_TEXT_DESCRIPTION_VALUE']['TEXT'])) {
                ob_start(); ?>
                <div class="group_description_block bottom muted777">
                    <div><?= $ob['PROPERTY_TEXT_DESCRIPTION_VALUE']['TEXT'] ?></div>
                </div>
                <? $html = ob_get_clean();
                $APPLICATION->AddViewContent('bottom_desc', $html);
            }
        }
    }
}