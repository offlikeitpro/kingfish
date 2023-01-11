<? use  \Bitrix\Main\Loader;

$arClasses = array(
    '\MyProjectNameSpace\MySuperImport' => '/local/include/import/export_update.php',
);

foreach ($arClasses as $Class => $Path) {
    Loader::registerAutoLoadClasses(null, array(
        $Class => $Path,
    ));
}
?>