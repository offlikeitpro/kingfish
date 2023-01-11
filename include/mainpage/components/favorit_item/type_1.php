<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
}?>
<?$APPLICATION->IncludeComponent("aspro:wrapper.block.max", "template1", Array(
	"IBLOCK_TYPE" => "1c_catalog",	// Тип инфоблока
		"IBLOCK_ID" => "43",	// Инфоблок
		"FILTER_NAME" => "arRegionLink",	// Имя массива со значениями фильтра для фильтрации элементов
		"COMPONENT_TEMPLATE" => ".default",
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "",	// Код раздела
		"FILTER_PROP_CODE" => "FAVORIT_ITEM",	// Свойство отбора
		"ELEMENT_SORT_FIELD" => "sort",	// По какому полю сортируем элементы
		"ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки элементов
		"ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки элементов
		"ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"SHOW_ALL_WO_SECTION" => "Y",	// Показывать все элементы, если не указан раздел
		"HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
		"ELEMENT_COUNT" => "30",	// Количество элементов на странице
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"DISPLAY_COMPARE" => "Y",	// Выводить кнопку сравнения
		"SHOW_MEASURE" => "Y",	// Отображать единицы измерения
		"DISPLAY_WISH_BUTTONS" => "Y",	// Показывать добавление в отложенные
		"SHOW_DISCOUNT_PERCENT" => "Y",	// Отображать экономию
		"SHOW_DISCOUNT_PERCENT_NUMBER" => "Y",	// Отображать процент экономии
		"SHOW_DISCOUNT_TIME" => "Y",	// Отображать срок действия скидки
		"SHOW_OLD_PRICE" => "Y",	// Отображать старую цену
		"PROPERTY_CODE" => array(
			0 => "CML2_ARTICLE",
		),
		"PRICE_CODE" => array(	// Тип цены
			0 => "BASE",
		),
		"ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров
		"PRODUCT_PROPERTIES" => "",	// Характеристики товара
		"PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
		"SHOW_RATING" => "Y",	// Отображать рейтинг
		"STIKERS_PROP" => "HIT",	// Свойство со стикерами
		"SALE_STIKER" => "SALE_TEXT",	// Свойство со стикером акций
		"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
		"TITLE_BLOCK" => "Товар дня",	// Заголовок блока
		"STORES" => array(	// Склады
			0 => "",
			1 => "",
		),
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"TITLE_BLOCK_ALL" => "Весь каталог",	// Заголовок в каталог
		"ALL_URL" => "catalog/",	// Ссылка в каталог
	),
	false
);?>