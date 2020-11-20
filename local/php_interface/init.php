<?
//define('VUEJS_DEBUG', true);
define('DBOGDANOFF_VUE_PATH', '/components-vue');
Bitrix\Main\Loader::registerAutoLoadClasses(null, [
    'DataCurrency\CurrencyTable' => '/local/php_interface/lib/data/CurrencyTable.php',
]);