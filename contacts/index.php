<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Контакты, адреса, телефоны - Интернет-магазин Kingfish.by");
$APPLICATION->SetPageProperty("title", "Интернет-магазин Kingfish.by: Контакты");
$APPLICATION->SetTitle("Контакты");?>
<h1 style="padding: 2rem 0 2rem 5rem;"><?$APPLICATION->ShowTitle(false);?></h1>
<?CMax::ShowPageType('page_contacts');?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>